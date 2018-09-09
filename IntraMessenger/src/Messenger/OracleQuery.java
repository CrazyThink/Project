package Messenger;
import java.sql.*;

public class OracleQuery {
	
	public static ResultSet oracleQuery(String sal) {
		try{
		ResultSet resultSet = Login.OracleLogin.statement.executeQuery(sal); //쿼리보내고 결과값 저장
		return resultSet;
		}catch(SQLException e){
			System.out.println("oraclequery 예외발생");
			//e.printStackTrace();
		}
		return null;
	}
}