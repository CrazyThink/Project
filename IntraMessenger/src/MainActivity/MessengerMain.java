package MainActivity;

import java.awt.*;

import javax.swing.*;

import java.awt.event.*;

public class MessengerMain {
	
	static String ID;
	static String PW;
	static JFrame frm = new JFrame("IntraMessenger");
	static public ImageIcon icon = new ImageIcon("rsrc/icon.png");
	
	public static void main(String[] args) {
		/*try{
			UIManager.setLookAndFeel("javax.swing.plaf.nimbus.NimbusLookAndFeel");
		}
		catch(Exception e){
			System.out.println("LookAndFeel ���ܹ߻�");
			//e.printStackTrace();
		}*/
		frm.setBounds(100, 100, 200, 120);
		frm.setLayout(new GridLayout(3,2));
		frm.setIconImage(icon.getImage());
		frm.setResizable(false);
		
		JLabel idLabel = new JLabel("ID ", SwingConstants.RIGHT);
		JTextField idText = new JTextField(10);
		
		JLabel pwLabel = new JLabel("Password ", SwingConstants.RIGHT);
		JPasswordField pwText = new JPasswordField(10);
		pwText.setEchoChar('*');
		pwText.addActionListener(new PWHandler(idText, pwText)); //�����ϸ� ID�� PW ����
		
		JButton join = new JButton("ȸ������");
		join.addActionListener(new Login.Join());
		JButton login = new JButton("�α���");
		login.addActionListener(new PWHandler(idText, pwText)); //������ ID�� PW ����	
		
		frm.add(idLabel); frm.add(idText);
		frm.add(pwLabel); frm.add(pwText);
		frm.add(join); frm.add(login);
		
		//frm.setUndecorated(true);
		//JSlider trans = new JSlider(0, 255, 255);
		//frm.add(trans);		
		//Color al = new Color(120,120,120,trans.getValue());
		//frm.setBackground(al);
		//if(trans.getValueIsAdjusting())
		//	frm.setBackground(al);

		frm.setVisible(true); //�α��� ������ ����
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE); //X������ ����
	}
}

@SuppressWarnings("serial")
class IDPWException extends Exception{ //�α��� ���� ����ó��
	IDPWException(){
		super("���̵� Ȥ�� ��й�ȣ�� �߸��Ǿ����ϴ�.");
	}
}

class PWHandler implements ActionListener
{
	JTextField id;
	JPasswordField pw;
	
	PWHandler(JTextField id, JPasswordField pw){
		this.id = id;
		this.pw = pw;
	}
	
	public void actionPerformed(ActionEvent e){
		MessengerMain.ID = id.getText(); //IDĭ�� �Էµ� ���ڸ� ID�� ����
		MessengerMain.PW = new String(pw.getPassword()); //PW�� �Էµ� ���ڸ� PW�� ����
		id.setText(""); //�ʱ�ȭ
		pw.setText(""); //�ʱ�ȭ
		try{
			boolean result = Login.Login.login(MessengerMain.ID, MessengerMain.PW); //�α��� �޼ҵ� ȣ��
			if(result == false){
				IDPWException excpt = new IDPWException();
				throw excpt;
			}
		}
		catch(IDPWException excpt){ //�α��ο� �����ϸ� �����޼��� ��� �� ����
			System.out.println("�α��� ����");
			excpt.getMessage();
			return;
		}
		MessengerMain.frm.dispose(); //�α��� ������ ����
		Messenger.MessengerActivity.activity(); //���� ���α׷� ����
	}
}