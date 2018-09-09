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
			System.out.println("LookAndFeel 예외발생");
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
		pwText.addActionListener(new PWHandler(idText, pwText)); //엔터하면 ID와 PW 전달
		
		JButton join = new JButton("회원가입");
		join.addActionListener(new Login.Join());
		JButton login = new JButton("로그인");
		login.addActionListener(new PWHandler(idText, pwText)); //누르면 ID와 PW 전달	
		
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

		frm.setVisible(true); //로그인 프레임 생성
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE); //X누르면 꺼짐
	}
}

@SuppressWarnings("serial")
class IDPWException extends Exception{ //로그인 실패 예외처리
	IDPWException(){
		super("아이디 혹은 비밀번호가 잘못되었습니다.");
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
		MessengerMain.ID = id.getText(); //ID칸에 입력된 글자를 ID에 저장
		MessengerMain.PW = new String(pw.getPassword()); //PW에 입력된 글자를 PW에 저장
		id.setText(""); //초기화
		pw.setText(""); //초기화
		try{
			boolean result = Login.Login.login(MessengerMain.ID, MessengerMain.PW); //로그인 메소드 호출
			if(result == false){
				IDPWException excpt = new IDPWException();
				throw excpt;
			}
		}
		catch(IDPWException excpt){ //로그인에 실패하면 에러메세지 출력 후 종료
			System.out.println("로그인 실패");
			excpt.getMessage();
			return;
		}
		MessengerMain.frm.dispose(); //로그인 프레임 삭제
		Messenger.MessengerActivity.activity(); //메인 프로그램 실행
	}
}