package Messenger;

import java.awt.*;
import java.awt.event.*;
import java.sql.*;

import javax.swing.*;


class AddUser implements ActionListener{
	static JPanel search = new JPanel();
	static boolean flag_result;
	public void actionPerformed(ActionEvent e){	
		Color Gray = new Color(200, 200, 200);
		JTextField friend = new JTextField(15);
		JButton searchbutton = new JButton("검색");
		searchbutton.addActionListener(new SHandler(friend));
		JPanel searchword = new JPanel();
		searchword.setLayout(new BorderLayout());
		searchword.add(friend, BorderLayout.WEST);
		searchword.add(searchbutton, BorderLayout.EAST);
		searchbutton.setBackground(Gray);
		searchbutton.setBorderPainted(false);
		searchbutton.setFocusPainted(false);
		
		search.setLayout(new BorderLayout());
		search.add(searchword, BorderLayout.NORTH);
		
		MessengerActivity.flag_add = 1;
		MessengerActivity.frm.dispose();
		MessengerActivity.activity(); //프레임 다시 로딩함
		search = new JPanel();
	}
}

class SHandler implements ActionListener{
	static JTextField friend;
	static JPanel result = new JPanel();
	
	SHandler(JTextField friend){
		SHandler.friend = friend;
	}
	
	public void actionPerformed(ActionEvent e){	
		result = new JPanel();
		AddUser.flag_result = false;
		Login.OracleLogin.oracleLogin(); //오라클 로그인
		try{
			String search = "select name from login where ID = \'" + friend.getText() + "\'";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(search);
			String name_s = "null";
			if(resultSet.next()){
				Color Gray = new Color(200, 200, 200);
				AddUser.flag_result = true;
				
				result.setLayout(new BorderLayout());
				name_s = resultSet.getString("name");
				JButton ID = new JButton(friend.getText());
				JLabel name = new JLabel(name_s, SwingConstants.LEFT);
				
				ID.setBackground(Gray);
				ID.setBorderPainted(false);
				ID.setFocusPainted(false);
				ID.addActionListener(new AddHandler());
				
				result.add(ID, BorderLayout.CENTER);
				result.add(name, BorderLayout.EAST);
			}
			resultSet.close();
		}catch(SQLException e1){
			System.out.println("search 예외발생");
			//e.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //오라클 로그아웃
		MessengerActivity.frm.dispose();
		MessengerActivity.activity(); //프레임 다시 로딩함
	}
}

class AddHandler implements ActionListener{
	public void actionPerformed(ActionEvent e){
		Login.OracleLogin.oracleLogin(); //오라클 로그인
		try{
			String add = "update friends set U_" + Login.Login.getU_ID() + " = 1 where friend = \'" + SHandler.friend.getText() + "\'";
			Login.OracleLogin.statement.executeQuery(add);
			
		}catch(SQLException e1){
			System.out.println("search 예외발생");
			//e.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //오라클 로그아웃
		MessengerActivity.frm.dispose();
		MessengerActivity.activity(); //프레임 다시 로딩함
	}
}

class deleteUser implements ActionListener{ //친구삭제
	public void actionPerformed(ActionEvent e){
		ClickHandler.frm.dispose();
		Login.OracleLogin.oracleLogin(); //오라클 로그인
		try{
			String delete = "update friends set u_" + Login.Login.getU_ID() + "= 0 where friend = \'" + ClickHandler.friend_s + "\'";
			Login.OracleLogin.statement.executeQuery(delete); //데이터베이스에서 친구 삭제
		}catch(SQLException ex){
			System.out.println("deleteuser 예외발생");
			//ex.printStackTrace();
		}
		Login.OracleLogin.oracleLogout(); //오라클 로그아웃
		MessengerActivity.frm.dispose();
		MessengerActivity.activity(); //프레임 다시 로딩함
	}
}