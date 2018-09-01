using System.Collections.Generic;
using System.Linq;
using System.Windows;

namespace mazeProject
{
    public class Node
    {
        private Point child;
        private Node parent;

        public Node(Point child, Node parent)
        {
            this.child = child;
            setParent(parent);
        }

        public void setParent(Node parent)  { this.parent = parent; }
        public Point getChild()             { return child; }
        public Node getParent()             { return parent; }
    }

    public class TileNode
    {
        private Point startPoint;
        private Point nextPoint;
        private int step;

        public TileNode(Point startPoint, Point nextPoint, int step) {
            this.startPoint = startPoint;
            this.nextPoint = nextPoint;
            this.step = step;
        }

        public Point getStartPoint()        { return startPoint; }
        public Point getNextPoint()         { return nextPoint; }
        public int getStep()                { return step; }
    }

    class ShortestPath
    {
        private List<TileNode>[,] chache;
        private List<TileNode>[,] innerChache;
        static public int end_row = 4;   //도착지점 행
        static public int end_col = 1;   //도착지점 열
        static public int count = 0;     //도착지 로테이션 사용을 위함
        private int default_weight = (Constants.MAX_ARR_LEN * Constants.MAX_ARR_LEN) * 2;
        public ShortestPath()
        {
            chache = new List<TileNode>[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];
            for (int i = 0; i < Constants.MAX_ARR_LEN; i++)
                for (int j = 0; j < Constants.MAX_ARR_LEN; j++)
                    chache[i, j] = new List<TileNode>();
            
            innerChache = new List<TileNode>[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];
            for (int i = 0; i < Constants.MAX_ARR_LEN; i++)
                for (int j = 0; j < Constants.MAX_ARR_LEN; j++)
                    innerChache[i, j] = new List<TileNode>();
        }

        public void calculateInnerPath(Point p, Maze m, Mice mice)
        {

            int[,] dirPriority = new int[4, 2] { { 1, 0 }, { 0, 1 }, { -1, 0 }, { 0, -1 } };
            bool[,] visit = new bool[m.getRow() + 2, m.getCol() + 2];

            Queue<Node> buf = new Queue<Node>();
            Node resultNode = null;
            Point endPoint = mice.getCurPoint();

            buf.Enqueue(new Node(p, null));
            visit[(int)p.X, (int)p.Y] = true;

            do
            {
                Node curNode = buf.Dequeue();
                Point curPoint = curNode.getChild();

                if (curPoint.X == endPoint.X && curPoint.Y == endPoint.Y)
                    resultNode = curNode;

                for (int i = 0; i < 4; i++)
                {
                    int newX = (int)curPoint.X + dirPriority[i, 0];
                    int newY = (int)curPoint.Y + dirPriority[i, 1];

                    if (newX <= 0 || newY <= 0 || newX > m.getRow() || newY > m.getCol()) continue;
                    if (visit[newX, newY]) continue;
                    if (mice.getMemory(newX, newY) == 0) continue;
                    if (mice.getMemory(newX, newY) < 0 && !m.isAvailable(newX, newY)) continue;

                    Point newPoint = new Point(newX, newY);

                    buf.Enqueue(new Node(newPoint, curNode));
                    visit[newX, newY] = true;
                }
            } while (buf.Any());

            if (resultNode != null)
            {
                Node curNode = resultNode;
                int step = 1;

                Point startPoint = curNode.getChild();
                Point nextPoint = new Point(-1, -1);

                while (curNode != null)
                {
                    innerChache[(int)startPoint.X, (int)startPoint.Y].Add(new TileNode(p, nextPoint, step++));
                    curNode = curNode.getParent();
                    if (curNode == null) break;
                    nextPoint = startPoint;
                    startPoint = curNode.getChild();
                }
            }

        }

        public void clearInnerWay(Point startPoint)
        {
            int curX = (int)startPoint.X;
            int curY = (int)startPoint.Y;

            do
            {
                List<TileNode> temp = innerChache[curX, curY];

                TileNode target = null;
                for (int i = 0; i < temp.Count; i++)
                {
                    Point curPoint = temp[i].getStartPoint();
                    if (curPoint.X == startPoint.X && curPoint.Y == startPoint.Y)
                    {
                        target = temp[i];
                        break;
                    }
                }
                if (target != null)
                {
                    Point nextPoint = target.getNextPoint();
                    curX = (int)nextPoint.X;
                    curY = (int)nextPoint.Y;
                    temp.Remove(target);
                }
                else break;

            } while (curX > 0 && curY > 0);
        }

        public void rotation(Maze m, Mice mice, int temp = 0)
        {
            if (count != -1)            //스캔으로 도착지를 찾지 않았다면
            {
                //도착지 로테이션 구현
                //쥐가 기억하고 있는 위치이고, 벽이라면 목적지 변경
                while ((mice.getMemory().getMemory(end_row, end_col) == Constants.MEMORY && !m.isAvailable(end_row, end_col)) || temp == -1)
                {
                    if (end_col == 1 && end_row < m.getRow()) end_row++;
                    else if (end_col < m.getCol() && end_row == m.getRow()) end_col++;
                    else if (end_col == m.getCol() && end_row > 1) end_row--;
                    else if (end_col > 1 && end_row == 1) end_col--;
                    temp = 0;
                }
            }
        }

        public void calculatePath(Point p, Maze m, Mice mice)
        {
            
            int[,] dirPriority = new int[4, 2] { { 1, 0 }, { 0, 1 }, { -1, 0 }, { 0, -1 } };
            bool[,] visit = new bool[m.getRow() + 2, m.getCol() + 2];
                        
            Queue<Node> buf = new Queue<Node>();
            Node resultNode = null;
            
            buf.Enqueue(new Node(p,null));
            visit[(int)p.X, (int)p.Y] = true;

            do
            {
                Node curNode = buf.Dequeue();
                Point curPoint = curNode.getChild();

                if (curPoint.X == end_row && curPoint.Y == end_col) //도착지 로테이션 구현
                    resultNode = curNode;
                
                for (int i = 0; i < 4; i++)
                {
                    int newX = (int)curPoint.X + dirPriority[i, 0];
                    int newY = (int)curPoint.Y + dirPriority[i, 1];

                    if (newX <= 0 || newY <= 0 || newX > m.getRow() || newY > m.getCol()) continue;
                    if (visit[newX, newY]) continue;
                    if (mice.getMemory(newX, newY) > 0) continue;
                    if (mice.getMemory(newX, newY) != 0){
                        if (!m.isAvailable(newX, newY)) continue;
                    }        
                   
                    Point newPoint = new Point(newX, newY);
                
                    buf.Enqueue(new Node(newPoint, curNode));
                    visit[newX, newY] = true;
                }
            } while (buf.Any());
                       
            if (resultNode != null)
            {
                Node curNode = resultNode;
                Point startPoint = curNode.getChild();
                Point nextPoint = new Point(-1,-1);
                int step = 1;

                while (curNode != null)
                {                    
                    chache[(int)startPoint.X, (int)startPoint.Y].Add(new TileNode(p, nextPoint, step++));
                    curNode = curNode.getParent();
                    if (curNode == null) break;
                    nextPoint = startPoint;
                    startPoint = curNode.getChild();
                }
            }
        }

        public void clearWay(Point startPoint)
        {
            int curX = (int)startPoint.X;
            int curY = (int)startPoint.Y;

            do
            {
                List<TileNode> temp = chache[curX, curY];

                TileNode target = null;
                for (int i = 0; i < temp.Count; i++)
                {
                    Point curPoint = temp[i].getStartPoint();
                    if (curPoint.X == startPoint.X && curPoint.Y == startPoint.Y)
                    {
                        target = temp[i];
                        break;
                    }
                }
                if (target != null)
                {
                    Point nextPoint = target.getNextPoint();
                    curX = (int)nextPoint.X;
                    curY = (int)nextPoint.Y;
                    temp.Remove(target);
                }
                else break;
            } while (curX > 0 && curY > 0);
        }

        public TileNode getTile(Point startPoint, Point targetPoint)
        {
            List<TileNode> temp = chache[(int)targetPoint.X, (int)targetPoint.Y];

            TileNode target = null;
            for (int i = 0; i < temp.Count; i++)
            {
                Point curPoint = temp[i].getStartPoint();
                if (curPoint.X == startPoint.X && curPoint.Y == startPoint.Y)
                {
                    target = temp[i];
                    break;
                }
            }
            return target;
        }

        public TileNode getInnerTile(Point startPoint, Point targetPoint)
        {
            List<TileNode> temp = innerChache[(int)targetPoint.X, (int)targetPoint.Y];

            TileNode target = null;
            for (int i = 0; i < temp.Count; i++)
            {
                Point curPoint = temp[i].getStartPoint();
                if (curPoint.X == startPoint.X && curPoint.Y == startPoint.Y)
                {
                    target = temp[i];
                    break;
                }
            }
            return target;
        }

        public int getInnerWeight(int i, int j) 
        {
            TileNode tile = getInnerTile(new Point(i, j), new Point(i, j));
            if (tile != null) return tile.getStep();
            else return default_weight;
        }

        public int getOuterWeight(int i, int j)
        {
            TileNode tile = getTile(new Point(i, j), new Point(i, j));
            if (tile != null) return tile.getStep();
            else return default_weight;
        }
    }
}