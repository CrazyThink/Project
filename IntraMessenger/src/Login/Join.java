package Login;

import java.awt.*;
import java.awt.event.*;
import java.sql.*;
import javax.swing.*;

public class Join implements ActionListener{
	static JFrame frm = new JFrame("IntraMessenger");
	private static boolean flag = true; 
	
	public void actionPerformed(ActionEvent e){
		frm.setBounds(100, 220, 200, 160);
		frm.setLayout(new GridLayout(4, 2));
		frm.setResizable(false);
		JLabel name_L = new JLabel("�̸� : ", SwingConstants.RIGHT);
		JTextField name_T = new JTextField(10);
		JLabel id_L = new JLabel("ID : ", SwingConstants.RIGHT);
		JTextField id_T = new JTextField(10);
		JLabel pw_L = new JLabel("PW : ", SwingConstants.RIGHT);
		JPasswordField pw_T = new JPasswordField(10);
		pw_T.setEchoChar('*');
		JButton join = new JButton("����");
		join.addActionListener(new joinHandler(name_T, id_T, pw_T));
		JButton reset = new JButton("�ٽ��Է�");
		reset.addActionListener(new resetHandler(name_T, id_T, pw_T));
		
		if(flag){ //������ ���� ����Ͽ� �����ϴ� ���� ����
			frm.add(name_L); frm.add(name_T);
			frm.add(id_L); frm.add(id_T);
			frm.add(pw_L); frm.add(pw_T);
			frm.add(join); frm.add(reset);
			flag = false;
		}
		
		frm.setVisible(true); //������ ����
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE); //X������ ����
	}
	
}

class joinHandler implements ActionListener{
	JTextField name;
	JTextField id;
	JPasswordField pw;
	
	joinHandler(JTextField name, JTextField id, JPasswordField pw){
		this.name = name;
		this.id = id;
		this.pw = pw;
	}
	
	public void actionPerformed(ActionEvent e){
		Join.frm.dispose();
		OracleLogin.oracleLogin(); //����Ŭ �α���
		int num_s = 0;
		try{
			String num = "select num from login order by num desc";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(num);
			if(resultSet.next())
				num_s = resultSet.getInt("num");
			resultSet.close();
			String join = "insert into login values (" + ++num_s + ", \'" + id.getText() + "\', \'" + new String(pw.getPassword()) + "\', \'" + name.getText() + "\')";
			OracleLogin.statement.executeQuery(join);
			join = "alter table friends add (U_" + id.getText() + " varchar(20))";
			OracleLogin.statement.executeQuery(join);
			join = "insert into friends (friend) values (\'" + id.getText() + "\')";
			OracleLogin.statement.executeQuery(join);
			id.setText(""); //�ʱ�ȭ
			pw.setText(""); //�ʱ�ȭ
			name.setText(""); //�ʱ�ȭ
		}catch(SQLException e1){
			System.out.println("join ���ܹ߻�");
			//e1.printStackTrace();
		}
		OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
	}
}

class resetHandler implements ActionListener{
	JTextField name;
	JTextField id;
	JPasswordField pw;
	
	resetHandler(JTextField name, JTextField id, JPasswordField pw){
		this.name = name;
		this.id = id;
		this.pw = pw;
	}
	
	public void actionPerformed(ActionEvent e){
		id.setText(""); //�ʱ�ȭ
		pw.setText(""); //�ʱ�ȭ
		name.setText(""); //�ʱ�ȭ
	}
}