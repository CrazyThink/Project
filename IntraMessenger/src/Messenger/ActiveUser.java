package Messenger;
import java.net.URL;
import java.sql.*;
import java.awt.*;
import java.awt.event.*;

import javax.swing.*;

class chat implements ActionListener{ //��ȭ����
	static JTextArea textArea;
	static int chatnum = 1; //ä�ù� ��ȣ
	static ImageIcon title_i;
	static ImageIcon back_i;
	static ImageIcon exit_i;
	static ImageIcon min_i;
	
	chat() {
		URL img = getClass().getClassLoader().getResource("title.png");
		title_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("back.png");
		back_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("exit.png");
		exit_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("min.png");
		min_i = new ImageIcon(img);
	}
	
	
	public void actionPerformed(ActionEvent e){	
		@SuppressWarnings("unused")
		chat n = new chat();
		ClickHandler.frm.dispose();
		textArea = new JTextArea(10, 20);
		final JFrame frm = new JFrame("IntraMessenger");
		frm.setBounds(330,100,230,500);
		frm.setLayout(new BorderLayout());
		frm.setResizable(false);
		frm.setIconImage(MainActivity.MessengerMain.icon.getImage());
		
		JLabel titlename = new JLabel(title_i);
		JButton min = new JButton(min_i);
		JButton exit = new JButton(exit_i);
		JPanel control = new JPanel();
		control.setLayout(new GridLayout());
		control.add(min);
		control.add(exit);
		JPanel title = new JPanel();
		title.setLayout(new BorderLayout());
		title.add(titlename, BorderLayout.CENTER);
		title.add(control, BorderLayout.EAST);
		
		JButton friendname = new JButton(ClickHandler.friend_s);
		
		JPanel up = new JPanel();
		up.setLayout(new BorderLayout());
		up.add(title, BorderLayout.NORTH);
		up.add(friendname, BorderLayout.CENTER);

		Color Brown = new Color(64,0,0);
		Color ChatBrown = new Color(185,122,87);
		Color White = new Color(255,255,255);
		min.setBackground(Brown);
		exit.setBackground(Brown);
		friendname.setBackground(ChatBrown);
		friendname.setForeground(White);
		min.setBorderPainted(false);
		min.setFocusPainted(false);
		exit.setBorderPainted(false);
		exit.setFocusPainted(false);
		friendname.setBorderPainted(false);
		friendname.setFocusPainted(false);
		
		
		JTextField content = new JTextField(10);
		textArea.setLineWrap(true);
		textArea.setEditable(false);
		
		JPanel chatform = new JPanel();
		chatform.setLayout(new BorderLayout());
		chatform.add(textArea, BorderLayout.CENTER);
		chatform.add(content, BorderLayout.AFTER_LAST_LINE);
		
		JScrollPane simpleScroll = new JScrollPane(textArea, ScrollPaneConstants.VERTICAL_SCROLLBAR_ALWAYS, ScrollPaneConstants.HORIZONTAL_SCROLLBAR_NEVER);
		chatform.add(simpleScroll);
		
		saveChatnum();
		int chatnum = chat.chatnum;
		CHandler.load();
		content.addActionListener(new CHandler(textArea, content, chatnum));
		for(int num = 0; num < MessengerActivity.flag_F.length; num++){
			if((MessengerActivity.flag_F[num].compareTo(ClickHandler.friend_s) == 0) && (MessengerActivity.flag_V[num])){
				ActiveLoad loadchat = new ActiveLoad();
				loadchat.start(); //������ ����
				MessengerActivity.flag_V[num] = false;
			}
		}
		
		
		min.addActionListener(new ActionListener() { //�ּ�ȭ
			public void actionPerformed(ActionEvent arg0) {
				frm.setState(Frame.ICONIFIED);
			}
		});
		exit.addActionListener(new ActionListener() { //�ݱ�
			public void actionPerformed(ActionEvent arg0) {
				frm.dispose();	
			}
		});
		frm.add(up, BorderLayout.NORTH);
		frm.add(chatform, BorderLayout.CENTER);
		frm.setUndecorated(true);
		frm.setVisible(true);
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE);	
	}
	
	void saveChatnum(){
		Login.OracleLogin.oracleLogin(); //����Ŭ �α���
		int num1 = 0, num2 = 0;
		try{
			String chatnum = "select U_" + Login.Login.getU_ID() + " from friends where friend = \'" + ClickHandler.friend_s +"\'";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(chatnum);
			if(resultSet.next())
				num1 = resultSet.getInt("U_" + Login.Login.getU_ID());
			resultSet.close();
			chatnum = "select U_" + ClickHandler.friend_s + " from friends where friend = \'" + Login.Login.getU_ID() +"\'";
			resultSet = Messenger.OracleQuery.oracleQuery(chatnum); 		
			if(resultSet.next())
				num2 = resultSet.getInt("U_" + ClickHandler.friend_s);
			resultSet.close();
			
			if(num1 > 1) //���� �����Ѵٸ�
				chat.chatnum = num1;
			else if((num1 == num2) && (num1 == 1)){ //ģ���̰�, ���� �������� �ʴ´ٸ�
				chatnum = "select topnum from chatnum";
				resultSet = Messenger.OracleQuery.oracleQuery(chatnum);		
				if(resultSet.next())
					chat.chatnum = resultSet.getInt("topnum") + 1; //�ְ��ȣ + 1
				resultSet.close();
				chatnum = "update friends set U_" + Login.Login.getU_ID() + " = " + chat.chatnum + " where friend = \'" + ClickHandler.friend_s +"\'";
				Login.OracleLogin.statement.executeQuery(chatnum);
				chatnum = "update friends set U_" + ClickHandler.friend_s + " = " + chat.chatnum + " where friend = \'" + Login.Login.getU_ID() +"\'";
				Login.OracleLogin.statement.executeQuery(chatnum);
				chatnum = "insert into activechat (chatnum) values (" + chat.chatnum + ")";
				Login.OracleLogin.statement.executeQuery(chatnum);
				chatnum = "update chatnum set topnum = " + chat.chatnum;
				Login.OracleLogin.statement.executeQuery(chatnum);
			}
			else{
				chat.chatnum = 1;
				System.out.println("���� ģ������� �Ǿ�߸� ��ȭ�� �����ؿ�. ����� ģ�� ���� �ڵ��� ä�ù�");
			}
		}catch(SQLException e){
			System.out.println("saveChatnum ���ܹ߻�");
			e.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
	}
}

class CHandler implements ActionListener
{
	JTextField content;
	JTextArea textArea;
	int chatnum = 1;
	
	CHandler(JTextArea textArea, JTextField content, int chatnum){
		this.textArea = textArea;
		this.content = content;
		this.chatnum = chatnum;
	}
	
	public void actionPerformed(ActionEvent e){
		if(content.getText().compareTo("") == 0)
			return;
		save_load(content.getText());
		content.setText("");
	}
	
	static void lastLoad(JTextArea textArea, int chatnum){
		try{
			String active = "select line from activechat where chatnum = " + chatnum; //���ڸ� ������������ ����
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(active);
			int line_s = 0;
			if(resultSet.next())
				line_s = resultSet.getInt("line");
			resultSet.close();

			String load = "select ID, contents from chat where num = " + line_s;
			resultSet = Messenger.OracleQuery.oracleQuery(load); //�����ͺ��̽����� ��ȭ �ε�			
			String ID_s = "null";
			String contents_s = "null";
			if(resultSet.next()){
				ID_s = resultSet.getString("ID");
				contents_s = resultSet.getString("contents");
			}
			resultSet.close();
			
			textArea.append(ID_s + " : " + contents_s + "\n"); //ȭ�鿡 ���
			textArea.setCaretPosition(textArea.getText().length()); //���� �ٷ� Ŀ�� �̵�
		}catch(SQLException e){
			System.out.println("lastload ���ܹ߻�");
			//e.printStackTrace();
		}
	}
	
	static void load(){
		chat.textArea.setText("");
		Login.OracleLogin.oracleLogin(); //����Ŭ �α���
		try{
			String load = "select ID, contents from chat where chatnum = " + chat.chatnum + " order by num";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(load); //�����ͺ��̽����� ��ȭ �ε�
				
			while(resultSet.next()){
				String ID_s = resultSet.getString("ID");
				String contents_s = resultSet.getString("contents");
				chat.textArea.append(ID_s + " : " + contents_s + "\n"); //ȭ�鿡 ���
			}
		}catch(SQLException e){
			System.out.println("load ���ܹ߻�");
			//e.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
	}
	
	void save_load(String content){
		Login.OracleLogin.oracleLogin(); //����Ŭ �α���
		int num = 0;
		try{
			String load = "select num from chat order by num desc"; //���ڸ� ������������ ����
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(load);
			if(resultSet.next())
				num = resultSet.getInt("num"); //���� ù ��° ����(���� ū ����)�� �����Ͽ� ����
			
			String num_s = "" + ++num; //num�� primaryŰ �̹Ƿ� ���� ���ڰ� �����ϸ� �ȵǹǷ� ���� �����ϸ� ������
			String save = "insert into chat values (" + num_s + ", \'" + content + "\', " + this.chatnum + ", \'" + Login.Login.getU_ID() + "\')";
			Login.OracleLogin.statement.executeQuery(save); //�Է��� ��ȭ�� �����ͺ��̽��� ����
			
			String update1 = "update activechat set line = " + num + " where chatnum = " + this.chatnum;
			String update2 = "update activechat set value = \'" + ClickHandler.friend_s + "\' where chatnum = " + this.chatnum;
			Login.OracleLogin.statement.executeQuery(update1);
			Login.OracleLogin.statement.executeQuery(update2);
			resultSet.close();
		}catch(SQLException e){
			System.out.println("save_load ���ܹ߻�");
			//e.printStackTrace();
		}
		lastLoad(this.textArea, this.chatnum);
		Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
	}
}