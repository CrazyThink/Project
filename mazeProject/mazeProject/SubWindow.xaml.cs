using System;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Input;
using System.Windows.Media.Imaging;
using System.IO;
using System.Windows.Threading;

namespace mazeProject
{
    public partial class SubWindow : Window
    {
        private String filePath;
        private Simulation curSimul;
        private bool isPlay;
        public DispatcherTimer Timer = new DispatcherTimer();

        public SubWindow(String filePath)
        {
            InitializeComponent();

            this.SizeToContent = SizeToContent.WidthAndHeight;
            this.filePath = filePath;

            String content = File.ReadAllText(filePath);
            curSimul = new Simulation(content, myCanvas, statusLog, rightPanel, hpStatus, mpStatus);
            curSimul.initCanvas();

            isPlay = true;
            Timer.Interval = TimeSpan.FromSeconds(0.5);
            Timer.Tick += new EventHandler(timer_Tick);
            Timer.Start();
        }

        public void Action()
        {
            if (curSimul.actionState % 4 == 0)          //목적지 방향의 외부와 연결된 내부 길을 계산한다.
                curSimul.calculateInner();
            else if (curSimul.actionState % 4 == 1) {   //내부의 말단 길로부터 목적지 방향으로 갈수 있는 모든 외부 길을 계산한다.
                curSimul.calculateInnerUndo();
                curSimul.calculate();
            }
            else if (curSimul.actionState % 4 == 2) {   //내부와 외부길에 대해 계산한 값을 기준으로 가장 짧은 길을 최종적으로 선정한다.
                curSimul.calculateUndo();
                curSimul.calculateBest();
            }
            else {                                      //최종적으로 선정된 길의 방향으로 이동한다.
                curSimul.calculateBestUndo();
                int ret = curSimul.play();
                if (ret == -1 || ret == 1) {
                    Timer.Stop();
                    if (ret == -1) MessageBox.Show("NO EXIT!!");
                    else MessageBox.Show("미로 탈출 성공!!");
                }
            }
            curSimul.actionState++;
        }

        private void timer_Tick(object sender, EventArgs e)
        {
            Action();
        }

        private void calculate(object sender, RoutedEventArgs e)
        {
            if(isPlay) {
                Timer.Stop();
                BitmapImage bi = new BitmapImage();
                bi.BeginInit();
                bi.UriSource = new Uri("Resources/play.png", UriKind.Relative);                
                bi.EndInit();
                
                playStatus.Source = bi;
            }
            Action();
        }

        private void togglePlay(object sender, RoutedEventArgs e)
        {
            isPlay = !(isPlay);

            BitmapImage bi = new BitmapImage();
            bi.BeginInit();
            if (isPlay) {
                Timer.Start();
                bi.UriSource = new Uri("Resources/stop.jpg", UriKind.Relative);
            }
            else {
                Timer.Stop();
                bi.UriSource = new Uri("Resources/play.png", UriKind.Relative);                
            }
            bi.EndInit();
            playStatus.Source = bi;
        }

        private void ListViewItem_PreviewMouseLeftButtonDown(object sender, MouseButtonEventArgs e)
        {
            var item = sender as ListViewItem;

            if (item != null) {
                if (isPlay) {
                    Timer.Stop();
                    BitmapImage bi = new BitmapImage();
                    bi.BeginInit();
                    bi.UriSource = new Uri("Resources/play.png", UriKind.Relative);
                    bi.EndInit();

                    playStatus.Source = bi;
                }
                State s = (State)item.Content;
                curSimul.loadState(s);
            }
        }

        private void intervalValueChanged(object sender, RoutedPropertyChangedEventArgs<double> e)
        {
            Timer.Interval = TimeSpan.FromSeconds(1 - e.NewValue * 0.01);
        }
    }
}