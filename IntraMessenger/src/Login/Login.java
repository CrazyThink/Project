package Login;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Login {

	private static String U_ID, U_PW;
	
	private static void setU_ID(String ID){ U_ID = ID; }
	public static String getU_ID(){ return U_ID; }
	
	private static void setU_PW(String PW){ U_PW = PW; }
	static String getU_PW(){ return U_PW; }
	
	public static boolean login(String ID, String PW){
		setU_ID(ID);
		setU_PW(PW);
		//Logincomp클래스의 특정한 메소드에서 값을 꺼내씀
		return LoginComp.loginComp();
	}
}

class LoginComp {
	/*
	 * {
	 * 		ID = getU_ID;
	 * 		PW = getU_PW;
	 * }
	 */
	static boolean loginComp() {
		OracleLogin.oracleLogin(); //오라클 로그인
		try{
			String login = "select num from login where ID = \'" + Login.getU_ID() + "\'" + "and PW = \'" + Login.getU_PW() + "\'";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(login);
			if(resultSet.next()) //ID와 PW를 동시에 검색하여 나온 필드가 있다면 로그인 성공
			{
				resultSet.close();
				OracleLogin.oracleLogout(); //오라클 로그아웃
				return true;
			}
			else
				return false;
		}catch(SQLException e){
			System.out.println("loginComp 예외발생");
			//e.printStackTrace();
		}	
		return false;
	}
}