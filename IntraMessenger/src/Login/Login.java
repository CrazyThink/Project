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
		//LogincompŬ������ Ư���� �޼ҵ忡�� ���� ������
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
		OracleLogin.oracleLogin(); //����Ŭ �α���
		try{
			String login = "select num from login where ID = \'" + Login.getU_ID() + "\'" + "and PW = \'" + Login.getU_PW() + "\'";
			ResultSet resultSet = Messenger.OracleQuery.oracleQuery(login);
			if(resultSet.next()) //ID�� PW�� ���ÿ� �˻��Ͽ� ���� �ʵ尡 �ִٸ� �α��� ����
			{
				resultSet.close();
				OracleLogin.oracleLogout(); //����Ŭ �α׾ƿ�
				return true;
			}
			else
				return false;
		}catch(SQLException e){
			System.out.println("loginComp ���ܹ߻�");
			//e.printStackTrace();
		}	
		return false;
	}
}