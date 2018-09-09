package Messenger;

import java.sql.*;
import javax.swing.JTextArea;

class ActiveLoad extends Thread{
	public void run(){
		int chatnum = chat.chatnum;
		JTextArea textArea = chat.textArea;
		while(true){
			ThreadOracleLogin.oracleLogin(); //����Ŭ �α���
			try{
				String active = "select value from activechat where chatnum = " + chatnum + " and value = \'" + Login.Login.getU_ID() + "\'";
				ResultSet resultSet =ThreadOracleQuery.oracleQuery(active);
				if(resultSet.next()){
					Login.OracleLogin.oracleLogin(); //����Ŭ �α���
					CHandler.lastLoad(textArea, chatnum);
					Login.OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
					String reset = "update activechat set value = 'null' where chatnum = " + chatnum;
					resultSet = ThreadOracleQuery.oracleQuery(reset);
				}
				resultSet.close();
			}catch(SQLException e){
				System.out.println("thread ���ܹ߻�");
				e.printStackTrace();
			}
			ThreadOracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
		}
	}
}

class ThreadOracleQuery {
	static ResultSet oracleQuery(String sal) {
		try{
		ResultSet resultSet = ThreadOracleLogin.statement.executeQuery(sal); //���������� ����� ����
		return resultSet;
		}catch(SQLException e){
			System.out.println("Threadoraclequery ���ܹ߻�");
			//e.printStackTrace();
		}
		return null;
	}
}

class ThreadOracleLogin {
	private static final String sid = "orcl";
	private static final String id = "scott";
	private static final String pass = "tiger";
	private static Connection connection = null;
	static Statement statement = null;
	
	static void oracleLogin(){
		try{
			Class.forName("oracle.jdbc.driver.OracleDriver");
		}catch(ClassNotFoundException e){
			System.out.println("����Ŭ JDBC ����̹� �ε� ����...");
			System.out.println(e.getMessage());
			System.exit(0);
		}	
			
		try{
			String url = "jdbc:oracle:thin:@48.2.50.24:1521:"+sid;
			connection = DriverManager.getConnection(url,id,pass);
			//System.out.println("���� / �α��� ����");
		}catch(SQLException e){
			//System.out.println("���� / �α��� ����");
		}
			
		try{
			statement = connection.createStatement();
			//System.out.println("statement ��ü ������");
		}catch (SQLException e){
			System.out.println("statement ��ü ���� ����");
			//e.printStackTrace();
		}
	}
	
	static void oracleLogout(){
		try{
			statement.close();
			connection.close();
		}catch(SQLException e){
			System.out.println("oraclelogout ���ܹ߻�");
			//e.printStackTrace();
		}
	}
}