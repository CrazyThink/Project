using System;
using System.Windows;

namespace mazeProject
{
    public static class Constants
    {
        public const int MAX_ARR_LEN = 102; //최대 미로의 크기

        public const int OUTER_BOUND = -1;  //데코
        public const int OBSTACLE    =  1;  //벽

        public const int ROAD        =  0;  //길

        public const int MEMORY      = -1;  //기억된 공간은 메모리배열에 -1이 저장됨

        public const int SIGHT       =  1;  //시야 크기

        public const int startX      =  1;  //시작X
        public const int startY      =  2;  //시작Y

        public const int BOX_SIZE    = 15;  //맵의 한 칸의 크기(보여지는 부분)

        public const int DONT_KNOW   = -1000;

        public const int UP          = 0;
        public const int DOWN        = 1;
        public const int RIGHT       = 2;
        public const int LEFT        = 3;
    }

    class Maze
    {
        private int[,] mazeArr;     //미로데이터가 저장되어 있음
        private int row;
        private int col;

        public Maze(String str)     //초기 미로 정보를 str에 받아옴
        {
            mazeArr = new int[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];
            fillMaze(str);          //파일을 읽어 받아온 str의 정보를 mazeArr에 저장
        }

        public Maze(Maze m)
        {
            mazeArr = new int[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];

            this.row = m.getRow();
            this.col = m.getCol();

            for (int i = 0; i <= row + 1; i++)
                for (int j = 0; j <= col + 1; j++)
                    mazeArr[i, j] = m.getMazeArr(i, j);
        }

        private void fillMaze(String str)                   //미로에 정보를 저장
        {

            string[] words = str.Split('\n');
            row = words.Length;

            col = 0;
            if (row > 0)
                foreach (char c in words[0])
                {
                    if (c == ' ' || c=='\r') continue;
                    else col++;
                }
            else throw new SystemException("file has no maze data");

            int fixedRow = 0;
            if (col > 0)
            {
                for (int i = 0; i <= col + 1; i++)
                    mazeArr[fixedRow, i] = Constants.OUTER_BOUND;
                fixedRow++;
            }
            else throw new SystemException("there is no col");

            foreach (string s in words)
            {
                int tempCol = 1;
                foreach (char c in s)
                {
                    if (c == ' ' || c == '\r') continue;
                    mazeArr[fixedRow, tempCol] = c - '0';   //길과 벽으로 변환
                    tempCol++;
                }

                if (tempCol - 1 > col) throw new SystemException("shape of maze is not square");
                mazeArr[fixedRow, 0] = mazeArr[fixedRow, col + 1] = Constants.OUTER_BOUND;
                fixedRow++;
            }

            for (int i = 0; i <= col + 1; i++)
                mazeArr[fixedRow, i] = Constants.OUTER_BOUND;
        }

        public bool isAvailable(int i, int j)   { return (mazeArr[i, j] == 0); }
        public int getRow()                     { return row; }
        public int getCol()                     { return col; }
        public int getMazeArr(int i, int j)     { return mazeArr[i, j]; }

        public int setMazeToRoad(int i, int j)
        {   //외벽이 아닐때만 벽을 뚫고, 외벽이라면 벽을 뚫지 않는다.
            if (i != getRow() && j != getCol() && i != 1 && j != 1){
                mazeArr[i, j] = Constants.ROAD;
                return 30;
            }
            return 0;
        }

        public Boolean isEndPoint(Mice m)
        {   //출발지가 아니고, 자신의 위치 4방향에 출구가 있다면 탈출
            Point curPoint = m.getCurPoint(); 
            return !(curPoint.X == 2 && curPoint.Y == 2) && ((curPoint.X + 1 == row && mazeArr[(int)curPoint.X + 1, (int)curPoint.Y] == 0) || (curPoint.Y + 1 == col && mazeArr[(int)curPoint.X, (int)curPoint.Y + 1] == 0)
                 || (curPoint.X - 2 == 0 && mazeArr[(int)curPoint.X - 1, (int)curPoint.Y] == 0) || (curPoint.Y - 2 == 0 && mazeArr[(int)curPoint.X, (int)curPoint.Y - 1] == 0));
        }
    }
}