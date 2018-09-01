using System;
using System.Collections.Generic;
using System.Linq;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using System.Collections.ObjectModel;

namespace mazeProject
{
    class Simulation
    {
        private Canvas myCanvas;
        private ListView myListView;
        private DockPanel rightPanel;
        private ProgressBar hpStatus;
        private ProgressBar mpStatus;

        private Maze maze;
        private Mice mice;
        private ShortestPath shortPath;

        private ObservableCollection<State> stateLog;
        private Stack<Point> traceback;

        private int[,] dirPriority;

        private int minWeight;
        private int minInner;
        private int minOuter;

        private int scan_col = 4;   //스캔 열
        private int scan_row = 1;   //스캔 행

        public int actionState;

        public int MAX_HP;
        private int MIN_WEIGHT;

        private string[] resList = { "up.png", "down.png", "right.png", "left.png"};

        public Simulation(String content, Canvas myCanvas, ListView myListView, DockPanel rightPanel, ProgressBar hpStatus, ProgressBar mpStatus)
        {
            maze = new Maze(content);

            MAX_HP = 2 * maze.getRow() * maze.getCol();
            MIN_WEIGHT = (maze.getRow() * maze.getCol()) * 2;

            mice = new Mice(MAX_HP, 0);
            shortPath = new ShortestPath();

            traceback = new Stack<Point>();
            stateLog = new ObservableCollection<State>();

            traceback.Push(new Point(1, 2));

            dirPriority = new int[4, 2] { { 1, 0 }, { 0, 1 }, { -1, 0 }, { 0, -1 } };

            actionState = 0;
            
            this.myCanvas = myCanvas;
            this.myListView = myListView;
            this.rightPanel = rightPanel;
            this.hpStatus = hpStatus;
            this.mpStatus = mpStatus;
            hpStatus.Maximum = MAX_HP;
            hpStatus.Value = hpStatus.Maximum;
            mpStatus.Maximum = MAX_HP;
            mpStatus.Value = 0;

            this.myListView.ItemsSource = stateLog;
        }

        public void clearPath()
        {
            Point calcPoint = new Point(1, 2);
            for (int i = 1; i <= maze.getRow(); i++)
                for (int j = 1; j <= maze.getCol(); j++)
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        calcPoint = new Point(i, j);
                        shortPath.clearInnerWay(calcPoint);
                        shortPath.clearWay(calcPoint);
                    }
        }

        public Point getCurBestTarget()
        {            
            Point target = new Point(-1, -1);

            minWeight = MIN_WEIGHT;
            minInner = minWeight;
            minOuter = minWeight;

            int row = maze.getRow();
            int col = maze.getCol();

            for (int i = 1; i <= row; i++)
                for (int j = 1; j <= col; j++)
                {
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        int inner = shortPath.getInnerWeight(i, j);
                        int outer = shortPath.getOuterWeight(i, j);

                        if (minWeight > inner + outer && inner > 1)
                        {
                            minInner = inner;
                            minOuter = outer;
                            minWeight = inner + outer;
                            target = new Point(i, j);
                        }
                    }
                }
            return target;
        }

        public Point getCurBestPath(Point target)
        {
            Point nextPoint = target;
         
            if (target.X > 0 && target.Y > 0)
            {
                Point micePoint = mice.getCurPoint();

                for (int i = 0; i < 4; i++)
                {
                    int newX = (int)micePoint.X + dirPriority[i, 0];
                    int newY = (int)micePoint.Y + dirPriority[i, 1];

                    if (shortPath.getInnerTile(target, new Point(newX, newY)) != null)
                    {
                        nextPoint = new Point(newX, newY);
                        break;
                    }
                }
            }          
            return nextPoint;
        }

        public void calculateBest()
        {   

            Point target = getCurBestTarget();
            Point calcPoint = getCurBestPath(target);

            if (calcPoint.X < 0 && calcPoint.Y < 0) 
                return;

            TileNode startTile = shortPath.getInnerTile(target, target);
            
            Point curPoint = calcPoint;
            Point nextPoint = startTile.getNextPoint();
            do
            {
                if (!mice.isMyPoint(curPoint))
                {
                    if(mice.getMemory((int)curPoint.X,(int)curPoint.Y) == 0)
                        updateCanvas((int)curPoint.X, (int)curPoint.Y, "best_no.png");
                    else updateCanvas((int)curPoint.X, (int)curPoint.Y, "best.png");
                }
                if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                curPoint = nextPoint;
                startTile = shortPath.getInnerTile(target, curPoint);
                nextPoint = startTile.getNextPoint();
            } while (true);

            startTile = shortPath.getTile(target, target);

            curPoint = target;
            nextPoint = startTile.getNextPoint();
            do
            {
                if (!mice.isMyPoint(curPoint))
                {
                    if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                        updateCanvas((int)curPoint.X, (int)curPoint.Y, "best_no.png");
                    else updateCanvas((int)curPoint.X, (int)curPoint.Y, "best.png");
                }
                if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                curPoint = nextPoint;
                startTile = shortPath.getTile(target, curPoint);
                nextPoint = startTile.getNextPoint();
            } while (true);    
        }

        public void calculateBestUndo()
        {
            Point target = getCurBestTarget();
            Point calcPoint = getCurBestPath(target);

            if (calcPoint.X < 0 && calcPoint.Y < 0) return;

            TileNode startTile = shortPath.getInnerTile(target, target);

            Point curPoint = calcPoint;
            Point nextPoint = startTile.getNextPoint();

            do
            {
                if (!mice.isMyPoint(curPoint))
                {
                    if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                        updateCanvas((int)curPoint.X, (int)curPoint.Y, "no.png");
                    else revealCanvas((int)curPoint.X, (int)curPoint.Y);
                }
                if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                curPoint = nextPoint;
                startTile = shortPath.getInnerTile(target, curPoint);
                nextPoint = startTile.getNextPoint();
            } while (true);

            startTile = shortPath.getTile(target, target);

            curPoint = target;
            nextPoint = startTile.getNextPoint();

            do
            {
                if (!mice.isMyPoint(curPoint))
                {
                    if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                        updateCanvas((int)curPoint.X, (int)curPoint.Y, "no.png");
                    else revealCanvas((int)curPoint.X, (int)curPoint.Y);
                }
                if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                curPoint = nextPoint;
                startTile = shortPath.getTile(target, curPoint);
                nextPoint = startTile.getNextPoint();
            } while (true);
        }

        public void calculateInner()
        {
            Point calcPoint = new Point(1, 2);

            int row = maze.getRow();
            int col = maze.getCol();

            for (int i = 1; i <= row; i++)
                for (int j = 1; j <= col; j++)               
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        calcPoint = new Point(i, j);
                        shortPath.clearInnerWay(calcPoint);
                        shortPath.calculateInnerPath(calcPoint, maze, mice);
                        TileNode startTile = shortPath.getInnerTile(calcPoint, calcPoint);
                        if (startTile == null) continue;
                        Point curPoint = calcPoint;
                        Point nextPoint = startTile.getNextPoint();
                        do
                        {
                            if (!mice.isMyPoint(curPoint))
                                updateCanvas((int)curPoint.X, (int)curPoint.Y, "inner.png");
                            if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                            curPoint = nextPoint;
                            startTile = shortPath.getInnerTile(calcPoint, curPoint);
                            nextPoint = startTile.getNextPoint();
                        } while (true);
                    }
        }

        public void calculateInnerUndo()
        {
            Point calcPoint = new Point(1, 2);

            int row = maze.getRow();
            int col = maze.getCol();

            for (int i = 1; i <= row; i++)
                for (int j = 1; j <= col; j++)
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        calcPoint = new Point(i, j);
                        TileNode startTile = shortPath.getInnerTile(calcPoint, calcPoint);
                        if (startTile == null) continue;
                        Point curPoint = calcPoint;
                        Point nextPoint = startTile.getNextPoint();
                        do
                        {
                            if (!mice.isMyPoint(curPoint))
                            {
                                if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                                    updateCanvas((int)curPoint.X, (int)curPoint.Y, "no.png");
                                else revealCanvas((int)curPoint.X, (int)curPoint.Y);
                            }
                            if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                            curPoint = nextPoint;
                            startTile = shortPath.getInnerTile(calcPoint, curPoint);
                            nextPoint = startTile.getNextPoint();
                        } while (true);
                    }
        }

        public void calculate(int temp = 0)
        {
            Point calcPoint = new Point(1, 2);
            shortPath.rotation(maze, mice, temp);   //목적지 로테이션

            int row = maze.getRow();
            int col = maze.getCol();

            for (int i = 1; i <= row; i++)
                for (int j = 1; j <= col; j++)
                {
                    if (mice.getCurPoint().X == i && mice.getCurPoint().Y == j) continue;
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        calcPoint = new Point(i, j);
                        shortPath.clearWay(calcPoint);
                        shortPath.calculatePath(calcPoint, maze, mice);
                        if (temp == 0)              //길이 막혀있는 경우가 아니라면
                        {
                            TileNode startTile = shortPath.getTile(calcPoint, calcPoint);
                            if (startTile == null) continue;
                            Point curPoint = calcPoint;
                            Point nextPoint = startTile.getNextPoint();
                            do
                            {
                                if (!mice.isMyPoint(curPoint))
                                {
                                    if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                                        updateCanvas((int)curPoint.X, (int)curPoint.Y, "outer_no.png");
                                    else updateCanvas((int)curPoint.X, (int)curPoint.Y, "outer.png");
                                }
                                if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                                curPoint = nextPoint;
                                startTile = shortPath.getTile(calcPoint, curPoint);
                                nextPoint = startTile.getNextPoint();
                            } while (true);
                        }
                    }
            }
        }

        public void calculateUndo()
        {
            Point calcPoint = new Point(1, 2);

            int row = maze.getRow();
            int col = maze.getCol();

            for (int i = 1; i <= row; i++)
                for (int j = 1; j <= col; j++)
                    if (maze.isAvailable(i, j) && (mice.getMemory(i, j) == Constants.MEMORY))
                    {
                        calcPoint = new Point(i, j);                        
                        TileNode startTile = shortPath.getTile(calcPoint, calcPoint);
                        if (startTile == null) continue;
                        Point curPoint = calcPoint;
                        Point nextPoint = startTile.getNextPoint();
                        do
                        {
                            if (!mice.isMyPoint(curPoint))
                            {
                                if (mice.getMemory((int)curPoint.X, (int)curPoint.Y) == 0)
                                    updateCanvas((int)curPoint.X, (int)curPoint.Y, "no.png");
                                else revealCanvas((int)curPoint.X, (int)curPoint.Y);
                            }
                            if (nextPoint.X < 0 || nextPoint.Y < 0) break;
                            curPoint = nextPoint;
                            startTile = shortPath.getTile(calcPoint, curPoint);
                            nextPoint = startTile.getNextPoint();
                        } while (true);
                    }
        }

        public void loadState(State state)      //클릭한 번호로 상태를 로드(완벽하지는 않음)
        {
            int idx = stateLog.IndexOf(state);

            if (MessageBox.Show(idx + "번째로 돌아갑니까?", "Question", MessageBoxButton.YesNo, MessageBoxImage.Warning) == MessageBoxResult.No)
                return;
            
            for (int i = stateLog.Count - 1; i > idx; i--)
            {
                stateLog.RemoveAt(i);
                traceback.Pop();
            }

            clearPath();
            actionState = 0;

            maze = state.getMaze();
            mice = state.getMice();

            initCanvas();
        } 

        public void scan(int scanX, int scanY)
        {
            if (ShortestPath.count >= 0)       //마나가 10 이상이고, 도착지를 찾지 못했을 때 스캔
            {
                int temp = 0;
                int hp = mice.getHealthPoint();
                if ((MAX_HP - hp) % (MAX_HP / 100) < 10) {  //에너지가 1% 소모되면 목적지를 스캔
                    scanX = ShortestPath.end_row;
                    scanY = ShortestPath.end_col;

                    if (ShortestPath.end_row == 1)              { scanX--; scanY++; } //  위쪽 벽일 때
                    if (ShortestPath.end_col == 1)              { scanX++; scanY++; } //  왼쪽 벽일 때
                    if (ShortestPath.end_row == maze.getRow())  { scanX--; scanY++; } //아래쪽 벽일 때
                    if (ShortestPath.end_col == maze.getCol())  { scanX--; scanY--; } //오른쪽 벽일 때

                    temp ^= 1;
                }
                
                mice.scan(new Point(scanX, scanY), maze);

                for (int j = scanX - 1; j <= scanX + 1; j++)
                    for (int k = scanY - 1; k <= scanY + 1; k++)
                    {
                        revealCanvas(j, k);
                        if ((j == maze.getRow() || (k == maze.getCol() && j < maze.getRow() - 1) || (j == 1 && k < maze.getCol()) || k == 1) && maze.isAvailable(j, k))
                        {
                            ShortestPath.end_row = j;
                            ShortestPath.end_col = k;
                            ShortestPath.count = -1;
                        }
                    }

                if(temp == 0){                  //시작지점부터 시계방향으로 3X3 스캔
                    if      (scan_row < 3                   && scan_col <= maze.getCol() - 3) { scan_row  = 1;                 scan_col += 3;                }
                    else if (scan_row <= maze.getRow() - 3  && scan_col >  maze.getCol() - 3) { scan_row += 3;                 scan_col  = maze.getCol() - 2;}
                    else if (scan_row >  maze.getRow() - 3  && scan_col >= 3)                 { scan_row  = maze.getRow() - 2; scan_col -= 3;                }
                    else if (scan_row >= 3                  && scan_col <  3)                 { scan_row -= 3;                 scan_col  = 1;                }
                }
            }
            else if (ShortestPath.count >= -4)  //마나가 10 이상이고, 도착지를 찾았을 때 스캔 - 도착지 주변을 추가로 4번 스캔
            {
                mice.scan(new Point(scanX, scanY), maze);

                for (int j = scanX - 1; j <= scanX + 1; j++)
                    for (int k = scanY - 1; k <= scanY + 1; k++)
                        revealCanvas(j, k);

                if (ShortestPath.count == -1)
                {
                    if      (scan_row < 3                  && scan_col <  maze.getCol() - 3) { scan_row += 3; }
                    else if (scan_row <  maze.getRow() - 3 && scan_col >= maze.getCol() - 3) { scan_col -= 3; }
                    else if (scan_row >= maze.getRow() - 3 && scan_col > 3)                  { scan_row -= 3; }
                    else if (scan_row > 3                  && scan_col < 3)                  { scan_col += 3; }
                }
                else if (ShortestPath.count == -2) { 
                    if      (scan_row < 6                  && scan_col <  maze.getCol() - 3) { scan_col -= 3; }
                    else if (scan_row <  maze.getRow() - 3 && scan_col >= maze.getCol() - 6) { scan_row -= 3; }
                    else if (scan_row >= maze.getRow() - 6 && scan_col > 3)                  { scan_col += 3; }
                    else if (scan_row > 3                  && scan_col < 6)                  { scan_row += 3; }
                }
                else if (ShortestPath.count == -3) { 
                    if      (scan_row < 6                  && scan_col <  maze.getCol() - 6) { scan_col -= 3; }
                    else if (scan_row <  maze.getRow() - 6 && scan_col >= maze.getCol() - 6) { scan_row -= 3; }
                    else if (scan_row >= maze.getRow() - 6 && scan_col > 6)                  { scan_col += 3; }
                    else if (scan_row > 6                  && scan_col < 6)                  { scan_row += 3; }
                }
                ShortestPath.count--;
            }
        }

        //벽뚫기 - 자신과 도착점사이의 X와 Y방향의 차이를 보고 더욱 긴 방향으로 뚫음. 하지만 그쪽은 길이라면 짧은 쪽이라도 뚫음.
        public void buster(int newX, int newY)
        {
            //마나가 40 이상일 때
            int tempX = ShortestPath.end_row - newX;
            int tempY = ShortestPath.end_col - newY;

            int busterX = 0, busterY = 0;
            
            if      (tempX >= 0 && tempY < 0)       //자신으로부터 왼쪽 하단에 출구가 있다면
            {
                if (tempX >= -tempY) { busterX = newX + 1; busterY = newY; }
                else                 { busterX = newX; busterY = newY - 1; }
                if (maze.isAvailable(busterX, busterY))
                {
                    busterX = busterY = 0;
                    if (tempX < -tempY) { busterX = newX + 1; busterY = newY; }
                    else                { busterX = newX; busterY = newY - 1; }
                    if (maze.isAvailable(busterX, busterY)) { busterX = busterY = 0; }
                }
            }
            else if (tempX >= 0 && tempY >= 0)       //자신으로부터 오른쪽 하단에 출구가 있다면
            {
                if (tempX >= tempY) { busterX = newX + 1; busterY = newY; }
                else                { busterX = newX; busterY = newY + 1; }
                if (maze.isAvailable(busterX, busterY))
                {
                    busterX = busterY = 0;
                    if (tempX < tempY) { busterX = newX + 1; busterY = newY; }
                    else               { busterX = newX; busterY = newY + 1; }
                    if (maze.isAvailable(busterX, busterY)) { busterX = busterY = 0; }
                }
            }
            else if (tempX < 0 && tempY >= 0)       //자신으로부터 오른쪽 상단에 출구가 있다면
            {
                if (-tempX >= tempY) { busterX = newX - 1; busterY = newY; }
                else                 { busterX = newX; busterY = newY + 1; }
                if (maze.isAvailable(busterX, busterY))
                {
                    busterX = busterY = 0;
                    if (-tempX < tempY) { busterX = newX - 1; busterY = newY; }
                    else                { busterX = newX; busterY = newY + 1; }
                    if (maze.isAvailable(busterX, busterY)) { busterX = busterY = 0; }
                }
            }
            else if (tempX < 0 && tempY < 0)       //자신으로부터 왼쪽 상단에 출구가 있다면
            {
                if (-tempX >= -tempY) { busterX = newX - 1; busterY = newY; }
                else                  { busterX = newX; busterY = newY - 1; }
                if (maze.isAvailable(busterX, busterY))
                {
                    busterX = busterY = 0;
                    if (-tempX < -tempY) { busterX = newX - 1; busterY = newY; }
                    else                 { busterX = newX; busterY = newY - 1; }
                    if (maze.isAvailable(busterX, busterY)) { busterX = busterY = 0; }
                }
            }
                                                   //한 방향이라도 벽이면 벽을 뚫음
            if (busterX != 0 && busterY != 0) mice.minusManaPoint(maze.setMazeToRoad(busterX, busterY));
            revealCanvas(busterX, busterY);        //뚫은 부분 캔버스 갱신
        }

        public int play()                          //쥐의 전반적인 행동
        {
            if (!traceback.Any()) return -1;

            Point top = traceback.Peek();
            Point nextPoint = getCurBestPath(getCurBestTarget());


            while (nextPoint.X < 0 && nextPoint.Y < 0)  //길이 막혀있다면 목적지를 옮긴다.
            {
                calculate(-1);
                nextPoint = getCurBestPath(getCurBestTarget());
            }

            int newX = (int)nextPoint.X;
            int newY = (int)nextPoint.Y;

            updateCanvas((int)top.X, (int)top.Y, "road.png");
            updateCanvas(newX, newY, "mouse.png");

            int dir = mice.moveTo(nextPoint);   //다음 지점으로 이동

            if (mice.getManaPoint() > 10)       //마나가 10 이상이라면 스캔
            {
                int scanX = scan_row + 1;
                int scanY = scan_col + 1;
                scan(scanX, scanY);
            }

            hpStatus.Value = mice.getHealthPoint();
            mpStatus.Value = mice.getManaPoint();

            if (mice.getManaPoint() >= 30)      //마나가 30 이상이면
                buster(newX, newY);             //벽뚫기

            for (int j = newX - 1; j <= newX + 1; j++)
                for (int k = newY - 1; k <= newY + 1; k++)
                {
                    if (j < 0 || k < 0 || j >= Constants.MAX_ARR_LEN || k >= Constants.MAX_ARR_LEN) continue;
                    if (j == newX && k == newY) continue;

                    revealCanvas(j, k);
                }
            stateLog.Add(new State(maze, mice, "Resources/" + resList[dir]));

            traceback.Push(new Point(newX, newY));
            if (maze.isEndPoint(mice)) return 1;
                    
            object item = myListView.Items[stateLog.Count - 1];
            myListView.ScrollIntoView(item);            

            return 0;
        }

        public void revealCanvas(int i, int j)  //캔버스 갱신
        {
            int value = this.maze.getMazeArr(i, j);

            String uri = "box_02.png";
            switch (value)
            {
                case -1:
                    uri = "box_03.png";
                    break;
                case 1:
                    uri = "box_02.png";
                    break;
                case 0:
                    uri = "road.png";
                    break;
                case Constants.DONT_KNOW:
                    uri = "no.png";
                    break;
            }

            if (i == 1 && j == 2) uri = "start.png";
            else if (ShortestPath.count < 0 && i == ShortestPath.end_row && j == (ShortestPath.end_col)) uri = "end.png";

            Rectangle rect = (Rectangle)myCanvas.Children[i * (maze.getCol() + 2) + j];

            BitmapImage theImage = new BitmapImage(new Uri(uri, UriKind.Relative));
            ImageBrush myImageBrush = new ImageBrush(theImage);

            rect.Fill = myImageBrush;
        }

        public void updateCanvas(int i, int j, String uri)
        {
            Rectangle rect = (Rectangle)myCanvas.Children[i*(maze.getCol() + 2) + j];
            BitmapImage theImage = new BitmapImage(new Uri(uri, UriKind.Relative));
            ImageBrush myImageBrush = new ImageBrush(theImage);

            rect.Fill = myImageBrush;
        }

        public void initCanvas()                //캔버스 초기화
        {
            myCanvas.Children.Clear();

            int row = this.maze.getRow();
            int col = this.maze.getCol();

            myCanvas.Width = (col + 2) * Constants.BOX_SIZE;
            myCanvas.Height = rightPanel.Height = (row + 2) * Constants.BOX_SIZE;

            for (int i = 0; i <= row + 1; i++)
                for (int j = 0; j <= col + 1; j++)
                {
                    Rectangle myRectangle = new Rectangle();

                    int value = this.maze.getMazeArr(i, j);
                    if (value != -1 && this.mice.getMemory(i, j) == 0) value = Constants.DONT_KNOW;

                    String uri = "box_02.png";
                    switch (value)
                    {
                        case -1:
                            uri = "box_03.png";
                            break;
                        case 1:
                            uri = "box_02.png";
                            break;     
                        case 0:
                            uri = "road.png";                            
                            break;
                        case Constants.DONT_KNOW:
                            uri = "no.png";
                            break;
                    }

                    if (mice.isMyPoint(new Point(i, j))) uri = "mouse.png";
                    if (i == 1 && j == 2)                uri = "start.png";

                    BitmapImage theImage = new BitmapImage(new Uri(uri, UriKind.Relative));
                    ImageBrush myImageBrush = new ImageBrush(theImage);
                    
                    myRectangle.Fill = myImageBrush;

                    myRectangle.Width = Constants.BOX_SIZE;
                    myRectangle.Height = Constants.BOX_SIZE;

                    myCanvas.Children.Add(myRectangle);
                    Canvas.SetTop(myRectangle, Constants.BOX_SIZE * i);
                    Canvas.SetLeft(myRectangle, Constants.BOX_SIZE * j);
                }

            for (int i = 0; i <= row + 1; i++)
                for (int j = 0; j <= col + 1; j++)
                {
                    TextBlock textBlockTemp = new TextBlock();                    
                    textBlockTemp.Margin = new Thickness(Constants.BOX_SIZE * j, Constants.BOX_SIZE * i, 0, 0);
                    myCanvas.Children.Add(textBlockTemp);
                }
        }
    }
}