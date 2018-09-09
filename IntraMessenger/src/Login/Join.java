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
		JLabel name_L = new JLabel("이름 : ", SwingConstants.RIGHT);
		JTextField name_T = new JTextField(10);
		JLabel id_L = new JLabel("ID : ", SwingConstants.RIGHT);
		JTextField id_T = new JTextField(10);
		JLabel pw_L = new JLabel("PW : ", SwingConstants.RIGHT);
		JPasswordField pw_T = new JPasswordField(10);
		pw_T.setEchoChar('*');
		JButton join = new JButton("가입");
		join.addActionListener(new joinHandler(name_T, id_T, pw_T));
		JButton reset = new JButton("다시입력");
		reset.addActionListener(new resetHandler(name_T, id_T, pw_T));
		
		if(flag){ //프레임 수가 계속하여 증가하는 것을 방지
			frm.add(name_L); frm.add(name_T);
			frm.add(id_L); frm.add(id_T);
			frm.add(pw_L); frm.add(pw_T);
			frm.add(join); frm.add(reset);
			flag = false;
		}
		
		frm.setVisible(true); //프레임 생성
		frm.setDefaultCloseOperation(WindowConstants.DISPOSE_ON_CLOSE); //X누르면 꺼짐
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
		OracleLogin.oracleLogin(); //오라클 로그인
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
			id.setText(""); //초기화
			pw.setText(""); //초기화
			name.setText(""); //초기화
		}catch(SQLException e1){
			System.out.println("join 예외발생");
			//e1.printStackTrace();
		}
		OracleLogin.oracleLogout(); //오라클 로그아웃
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
		id.setText(""); //초기화
		pw.setText(""); //초기화
		name.setText(""); //초기화
	}
}