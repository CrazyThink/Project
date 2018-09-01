using System.Windows;
using Microsoft.Win32;

namespace mazeProject
{
    public partial class MainWindow : Window
    {
        private void btnOpenFile_Click(object sender, RoutedEventArgs e)
        {
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Filter = "Text files (*.txt)|*.txt|All files (*.*)|*.*";
            if (openFileDialog.ShowDialog() == true)
            {
                SubWindow subWindow = new SubWindow(openFileDialog.FileName);
                subWindow.Show();
                this.Close();
            }
        }
    }
}