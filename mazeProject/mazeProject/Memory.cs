using System.Windows;

namespace mazeProject
{
    class Memory
    {
        private int[,] mazeMemory;  //쥐가 기억하는 미로
        private int sight;          //시야
        private int step;           //이동횟수

        public Memory(int sight)
        {
            mazeMemory = new int[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];
            this.sight = sight;
            initMemory(new Point(1, 2));
        }

        public Memory(Memory m)
        {
            mazeMemory = new int[Constants.MAX_ARR_LEN, Constants.MAX_ARR_LEN];
            for (int i = 0; i < Constants.MAX_ARR_LEN; i++)
                for (int j = 0; j < Constants.MAX_ARR_LEN; j++)
                    mazeMemory[i, j] = m.getMemory(i, j);
            
            this.sight = m.getSight();
            this.step = m.getStep();
        }

        public void initMemory(Point startPoint)                //이동횟수 0, 시작지점 주변 시야 제공
        {
            this.step = 0;
            getNewMemory(startPoint);
        }

        public void getNewMemory(Point p)                       //매 이동마다 주변 시야 제공
        {
            int startX = (int)(p.X - sight);
            int endX   = (int)(p.X + sight);
            int startY = (int)(p.Y - sight);
            int endY   = (int)(p.Y + sight);

            mazeMemory[(int)(p.X), (int)(p.Y)] = ++this.step;   //내가 간 길의 mazeMemory 값을 이동횟수로 설정
            for (int i = startX; i <= endX; i++)
                for (int j = startY; j <= endY; j++)
                {
                    if (i < 0 || j < 0 || i >= Constants.MAX_ARR_LEN || j >= Constants.MAX_ARR_LEN) continue;
                    if (mazeMemory[i, j] > 0) continue;
                        mazeMemory[i, j] = Constants.MEMORY;
                }
        }

        public int getScanMemory(Point p, Maze m)               //스캔 사용시 주변 시야 제공
        {
            int count = 0;
            int startX = (int)(p.X - sight);
            int endX   = (int)(p.X + sight);
            int startY = (int)(p.Y - sight);
            int endY   = (int)(p.Y + sight);

            for (int i = startX; i <= endX; i++)
                for (int j = startY; j <= endY; j++)
                {
                    if (i < 0 || j < 0 || i >= Constants.MAX_ARR_LEN || j >= Constants.MAX_ARR_LEN) { count++; continue; }
                    if (mazeMemory[i, j] != 0) count++;
                    else mazeMemory[i, j] = Constants.MEMORY;
                }
            if (count == 9) return 0;                           //이미 다 아는 길이었다면 스캔을 사용하지 않음
            else return 10;
        }

        public int getSight()                   { return sight; }
        public int getMemory(int i, int j)      { return mazeMemory[i, j]; }
        public int getStep()                    { return step; }
    }
}