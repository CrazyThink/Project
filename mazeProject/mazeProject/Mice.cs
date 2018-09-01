using System.Windows;

namespace mazeProject
{
    class Mice
    {
        private Memory memory;          //현재 기억
        private Point curPoint;         //현재 위치
        private int healthPoint;        //현재 에너지
        private int manaPoint;          //현재 마나

        public Mice(int healthPoint, int manaPoint)
        {
            memory = new Memory(Constants.SIGHT);
            curPoint = new Point(Constants.startX, Constants.startY);
            getMemory((int)(curPoint.X), (int)(curPoint.Y));
            this.healthPoint = healthPoint;
            this.manaPoint = manaPoint;
        }

        public Mice(Mice mice)
        {
            memory = new Memory(mice.getMemory());
            curPoint = new Point(mice.getCurPoint().X, mice.getCurPoint().Y);
            this.healthPoint = mice.getHealthPoint();
            this.manaPoint = mice.getManaPoint();
        }

        public int getDirection(Point to)       //다음 위치의 방향 반환
        {
            int diffX = (int)(to.X - curPoint.X);
            int diffY = (int)(to.Y - curPoint.Y);

            if (diffX == 0)
                if (diffY > 0) return Constants.RIGHT;
                else return Constants.LEFT;
            else
                if (diffX > 0) return Constants.DOWN;
                else return Constants.UP;
        }

        public int moveTo(Point to)             //다음 위치로 이동
        {
            int dir = getDirection(to);
            curPoint = to;
            memory.getNewMemory(curPoint);
            healthPoint--;
            manaPoint++;
            return dir;
        }

        public void scan(Point to, Maze maze)   //스캔
        {
            if (manaPoint >= 10) minusManaPoint(memory.getScanMemory(to, maze));
        }
        public void minusManaPoint(int mana)    { manaPoint -= mana;}
        public Memory getMemory()               { return memory; }
        public int getMemory(int i, int j)      { return memory.getMemory(i, j); }
        public Point getCurPoint()              { return curPoint; }
        public int getHealthPoint()             { return healthPoint; }
        public int getManaPoint()               { return manaPoint; }
        public bool isMyPoint(Point p)          { return (curPoint.X == p.X && curPoint.Y == p.Y); }
    }
}