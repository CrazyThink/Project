package Messenger;
import java.net.URL;
import java.sql.*;
import java.awt.*;
import java.awt.event.*;

import javax.swing.*;

public class MessengerActivity {
	static String[] flag_F;
	static boolean[] flag_V;
	static int flag_FL;
	static int flag_add;
	static JFrame frm;
	static ImageIcon title_i;
	static ImageIcon empty_i;
	static ImageIcon exit_i;
	static ImageIcon min_i;
	static ImageIcon friends_i;
	static ImageIcon settings_i;
	static ImageIcon friendadd_i;
	
	MessengerActivity() {
		URL img = getClass().getClassLoader().getResource("title.png");
		title_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("empty.png");
		empty_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("exit.png");
		exit_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("min.png");
		min_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("friends.png");
		friends_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("settings.png");
		settings_i = new ImageIcon(img);
		img = getClass().getClassLoader().getResource("friendadd.png");
		friendadd_i = new ImageIcon(img);
	}
	
	public static void activity() { //�α��� �� ����ȭ��
		@SuppressWarnings("unused")
		MessengerActivity n = new MessengerActivity();
		frm = new JFrame("IntraMessenger");
		frm.setBounds(100,100,230,500);
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
		
		JButton friendslist = new JButton(friends_i);
		JButton settings = new JButton(settings_i);
		JPanel display = new JPanel();
		display.setLayout(new GridLayout(1,2));
		display.add(friendslist);
		display.add(settings);
		JLabel empty = new JLabel(empty_i);
		JPanel displayset = new JPanel();
		displayset.setLayout(new BorderLayout());
		displayset.add(display, BorderLayout.WEST);
		displayset.add(empty, BorderLayout.CENTER);
		
		JPanel up = new JPanel();
		up.setLayout(new BorderLayout());
		up.add(title, BorderLayout.NORTH);
		up.add(displayset, BorderLayout.CENTER);
		
		Color Brown = new Color(64,0,0);
		Color ChatBrown = new Color(185,122,87);
		Color Gray = new Color(200, 200, 200);
		min.setBackground(Brown);
		exit.setBackground(Brown);
		friendslist.setBackground(Brown);
		settings.setBackground(Brown);
		min.setBorderPainted(false);
		min.setFocusPainted(false);
		exit.setBorderPainted(false);
		exit.setFocusPainted(false);
		friendslist.setBorderPainted(false);
		friendslist.setFocusPainted(false);
		settings.setBorderPainted(false);
		settings.setFocusPainted(false);
		
		////���̾ƿ� ����
		
		Login.OracleLogin.oracleLogin(); //����Ŭ �α���
		
		String name_s = "null";
		try{
			String name = "select name from login where ID = \'" + Login.Login.getU_ID() + "\'";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(name);
			resultSet.next();
			name_s = resultSet.getString("name");
			resultSet.close();
		}catch(SQLException e){
			System.out.println("name ���ܹ߻�");
			//e.printStackTrace();
		}
		final JLabel IDLabel = new JLabel("�� ���̵� : " + Login.Login.getU_ID() + "(" + name_s + ")", SwingConstants.CENTER); //���̵�� �̸� ǥ��
		final JPanel friendPanel = new JPanel();
		friendPanel.setLayout(new GridLayout(40, 1, 10, 10));

		try{
			String friends = "select friend from friends where u_" + Login.Login.getU_ID() + ">= 1 order by friend";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(friends);
			int num = 0;
			while(resultSet.next())
				num++;
			MessengerActivity.flag_F = new String[num];
			MessengerActivity.flag_V = new boolean[num];
			num = 0;
			resultSet.close();
			resultSet = Messenger.OracleQuery.oracleQuery(friends);
			
			while(resultSet.next()){
				String friends_s = resultSet.getString("friend");
				
				Login.OracleLogin.oracleLogin(); //����Ŭ �α���
				String name = "select name from login where ID = \'" + friends_s + "\'";
				ResultSet resultSet_n = Login.OracleLogin.statement.executeQuery(name);
				resultSet_n.next();
				String name_f = resultSet_n.getString("name");
				resultSet_n.close();
				Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
				
				MessengerActivity.flag_F[num] = friends_s;
				MessengerActivity.flag_V[num++] = true;
				JButton friend = new JButton(friends_s);
				friend.setBackground(Gray);
				friend.setBorderPainted(false);
				friend.setFocusPainted(false);
				
				JLabel friend_ST = new JLabel(name_f,SwingConstants.LEFT);
				
				JPanel friendlist = new JPanel();
				friendlist.setLayout(new GridLayout(1,2));	
				friendlist.add(friend);
				friendlist.add(friend_ST);			
				friendPanel.add(friendlist);
				friend.addActionListener(new ClickHandler(friends_s)); //Ŭ���� ��ư�� ģ�� ���̵� ����
			}
			resultSet.close();
		}catch(SQLException e){
			System.out.println("friend ���ܹ߻�");
			//e.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�

		final JPanel contents = new JPanel();
		contents.setLayout(new BorderLayout());	
		
		if(flag_FL == 0){ //ģ�� �׸� ������ ��
			contents.add(IDLabel, BorderLayout.NORTH);
			contents.add(friendPanel, BorderLayout.CENTER);
		}
		else if(flag_FL == 1){ //...��ư ������ ��
			JButton friendadd = new JButton(friendadd_i);
			friendadd.setBackground(ChatBrown);
			friendadd.setBorderPainted(false);
			friendadd.setFocusPainted(false);
			JLabel empty1 = new JLabel("ģ", SwingConstants.CENTER);
			JLabel empty2 = new JLabel("��", SwingConstants.CENTER);
			JLabel empty3 = new JLabel("��", SwingConstants.CENTER);
			JLabel empty4 = new JLabel("��", SwingConstants.CENTER);

			friendadd.addActionListener(new AddUser());
			JPanel setting = new JPanel();
			setting.setLayout(new GridLayout(1,3));
			setting.add(friendadd);
			setting.add(empty1);
			setting.add(empty2);
			setting.add(empty3);
			setting.add(empty4);
			JPanel settingmenu = new JPanel();
			settingmenu.setLayout(new BorderLayout());
			settingmenu.add(setting, BorderLayout.NORTH);
			if(flag_add == 0){ //�˻���ư ������ ��
				JLabel empty0 = new JLabel("");
				settingmenu.add(empty0, BorderLayout.CENTER);
			}
			else if(flag_add == 1){ //�˻���ư ���� ��
				if(AddUser.flag_result == true)
					AddUser.search.add(SHandler.result, BorderLayout.SOUTH);
				settingmenu.add(AddUser.search, BorderLayout.CENTER);
			}
			contents.add(settingmenu, BorderLayout.CENTER);
		}
		
		friendslist.addActionListener(new ActionListener() { //ģ�����
			public void actionPerformed(ActionEvent arg0) {
				flag_FL = 0;
				flag_add = 0;
				frm.dispose();
				activity(); //������ �ٽ� �ε���
			}
		});
		settings.addActionListener(new ActionListener() { //�ΰ����
			public void actionPerformed(ActionEvent arg0) {
				flag_FL = 1;
				frm.dispose();
				activity(); //������ �ٽ� �ε���
			}
		});
		min.addActionListener(new ActionListener() { //�ּ�ȭ
			public void actionPerformed(ActionEvent arg0) {
				frm.setState(Frame.ICONIFIED);
			}
		});
		exit.addActionListener(new ActionListener() { //�ݱ�
			public void actionPerformed(ActionEvent arg0) {
				System.exit(0);
			}
		});
		frm.add(up, BorderLayout.NORTH);
		frm.add(contents, BorderLayout.CENTER);
		
		if(flag_FL == 0){
			JScrollPane simpleScroll = new JScrollPane(contents, ScrollPaneConstants.VERTICAL_SCROLLBAR_ALWAYS, ScrollPaneConstants.HORIZONTAL_SCROLLBAR_NEVER);
			frm.add(simpleScroll);
		}		
		
		frm.setUndecorated(true);
		frm.setVisible(true);
		//frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE);
		frm.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	}
}

class ClickHandler implements ActionListener{
	static JFrame frm = new JFrame("IntraMessenger");
	private static boolean flag = true;
	private String friend = "null";
	public static String friend_s = "null";
	
	ClickHandler(String friend){
		this.friend = friend;
	}
	
	public void actionPerformed(ActionEvent e){
		friend_s = friend;
		
		frm.setBounds(250, 100, 200, 200);
		frm.setIconImage(MainActivity.MessengerMain.icon.getImage());
		frm.setResizable(false);
		
		JButton chat_start = new JButton("��ȭ����");
		JButton delfriend = new JButton("ģ������");
		JButton cancel = new JButton("���");
		
		if(flag){ //������ ���� ����Ͽ� �����ϴ� ���� ����
			frm.setLayout(new GridLayout(3,1,2,2));
			frm.add(chat_start); frm.add(delfriend); frm.add(cancel);
			flag = false;
		}
		
		ActionListener actionHandler = new chat();
		chat_start.addActionListener(actionHandler);
		ActionListener actionHandler1 = new deleteUser();
		delfriend.addActionListener(actionHandler1);
		
		frm.setVisible(true);
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE);
	}
}