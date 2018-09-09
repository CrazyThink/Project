package Messenger;

import java.sql.*;
import javax.swing.JTextArea;

class ActiveLoad extends Thread{
	public void run(){
		int chatnum = chat.chatnum;
		JTextArea textArea = chat.textArea;
		while(true){
			ThreadOracleLogin.oracleLogin(); //오라클 로그인
			try{
				String active = "select value from activechat where chatnum = " + chatnum + " and value = \'" + Login.Login.getU_ID() + "\'";
				ResultSet resultSet =ThreadOracleQuery.oracleQuery(active);
				if(resultSet.next()){
					Login.OracleLogin.oracleLogin(); //오라클 로그인
					CHandler.lastLoad(textArea, chatnum);
					Login.OracleLogin.oracleLogout(); //오라클 로그아웃
					String reset = "update activechat set value = 'null' where chatnum = " + chatnum;
					resultSet = ThreadOracleQuery.oracleQuery(reset);
				}
				resultSet.close();
			}catch(SQLException e){
				System.out.println("thread 예외발생");
				e.printStackTrace();
			}
			ThreadOracleLogin.oracleLogout(); //오라클 로그아웃
		}
	}
}

class ThreadOracleQuery {
	static ResultSet oracleQuery(String sal) {
		try{
		ResultSet resultSet = ThreadOracleLogin.statement.executeQuery(sal); //쿼리보내고 결과값 저장
		return resultSet;
		}catch(SQLException e){
			System.out.println("Threadoraclequery 예외발생");
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
			System.out.println("오라클 JDBC 드라이버 로딩 실패...");
			System.out.println(e.getMessage());
			System.exit(0);
		}	
			
		try{
			String url = "jdbc:oracle:thin:@48.2.50.24:1521:"+sid;
			connection = DriverManager.getConnection(url,id,pass);
			//System.out.println("접속 / 로그인 성공");
		}catch(SQLException e){
			//System.out.println("접속 / 로그인 실패");
		}
			
		try{
			statement = connection.createStatement();
			//System.out.println("statement 객체 생성됨");
		}catch (SQLException e){
			System.out.println("statement 객체 생성 실패");
			//e.printStackTrace();
		}
	}
	
	static void oracleLogout(){
		try{
			statement.close();
			connection.close();
		}catch(SQLException e){
			System.out.println("oraclelogout 예외발생");
			//e.printStackTrace();
		}
	}
}