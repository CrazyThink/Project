package Login;
import java.sql.*;

public class OracleLogin {
	private static final String sid = "orcl";
	private static final String id = "scott";
	private static final String pass = "tiger";
	private static Connection connection = null;
	public static Statement statement = null;
	
	public static void oracleLogin(){
		try{
			Class.forName("oracle.jdbc.driver.OracleDriver");
		}catch(ClassNotFoundException e){
			System.out.println("오라클 JDBC 드라이버 로딩 실패...");
			//System.out.println(e.getMessage());
			System.exit(0);
		}	
			
		try{
			String url = "jdbc:oracle:thin:@48.2.50.24:1521:"+sid;
			connection = DriverManager.getConnection(url,id,pass);
			//System.out.println("오라클 로그인 성공");
		}catch(SQLException e){
			System.out.println("오라클 로그인 실패");
			//e.printStackTrace();
		}
			
		try{
			statement = connection.createStatement();
			//System.out.println("statement 객체 생성됨");
		}catch (SQLException e){
			System.out.println("statement 객체 생성 실패");
			//e.printStackTrace();
		}
	}
	
	public static void oracleLogout(){
		try{
			statement.close();
			connection.close();
		}catch(SQLException e){
			System.out.println("oraclelogout 예외발생");
			//e.printStackTrace();
		}
	}
}