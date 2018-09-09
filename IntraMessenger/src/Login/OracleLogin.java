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
			System.out.println("����Ŭ JDBC ����̹� �ε� ����...");
			//System.out.println(e.getMessage());
			System.exit(0);
		}	
			
		try{
			String url = "jdbc:oracle:thin:@48.2.50.24:1521:"+sid;
			connection = DriverManager.getConnection(url,id,pass);
			//System.out.println("����Ŭ �α��� ����");
		}catch(SQLException e){
			System.out.println("����Ŭ �α��� ����");
			//e.printStackTrace();
		}
			
		try{
			statement = connection.createStatement();
			//System.out.println("statement ��ü ������");
		}catch (SQLException e){
			System.out.println("statement ��ü ���� ����");
			//e.printStackTrace();
		}
	}
	
	public static void oracleLogout(){
		try{
			statement.close();
			connection.close();
		}catch(SQLException e){
			System.out.println("oraclelogout ���ܹ߻�");
			//e.printStackTrace();
		}
	}
}