using System;
using System.Windows;

namespace mazeProject
{
    class State                 //오른쪽 상태창 표현을 위해 작성
    {
        private Maze curMaze;
        private Mice curMice;

        public String dir { get; set; }
        public String step { get; set; }
        public String cord { get; set; }

        public State(Maze maze, Mice mice, String dir)
        {
            this.curMaze = new Maze(maze);
            this.curMice = new Mice(mice);

            Point p = curMice.getCurPoint();
            cord = "( " + p.X + " , " + p.Y + " ) ";

            step = "" + curMice.getMemory().getStep();

            this.dir = dir;
        }

        public Maze getMaze()               { return curMaze; }

        public Mice getMice()               { return curMice; }
    }
}