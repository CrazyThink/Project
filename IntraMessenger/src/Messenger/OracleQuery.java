package Messenger;
import java.sql.*;

public class OracleQuery {
	
	public static ResultSet oracleQuery(String sal) {
		try{
		ResultSet resultSet = Login.OracleLogin.statement.executeQuery(sal); //���������� ����� ����
		return resultSet;
		}catch(SQLException e){
			System.out.println("oraclequery ���ܹ߻�");
			//e.printStackTrace();
		}
		return null;
	}
}