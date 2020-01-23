/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import java.sql.*;

/**
 *
 * @author valek
 */
public class Conexion {
    ResultSet rs;
    Statement sentenciaSql;
    Connection cn;
    
    
    
    public Conexion(){
        rs=null;
        sentenciaSql = null;
        cn = null;
    }
    
    public ResultSet ejecutarSelect(String sentencia){//esta la usamos cuando el comando sea un select(si quiero consultar, )
		try{
		sentenciaSql = cn.createStatement();
		rs=sentenciaSql.executeQuery(sentencia);
		}
		catch(SQLException exp){
			System.out.println(exp.getMessage());		
	}
		return rs;
    
    }
    
  public void ejecutarUpdate(String sentencia){//y esta cuando sea inser,update,delete
            try{
                sentenciaSql=cn.createStatement();
                sentenciaSql.executeUpdate(sentencia);
            }
            catch(SQLException exp){
                System.out.println(exp.getMessage());
            }
        }
	public void abriBD(){
             String mx="";
		try
		{

		Class.forName("com.mysql.jdbc.Driver");

		 cn = DriverManager.getConnection("jdbc:mysql://localhost/bdClientesFacturas", "root", "");
		}
		catch(SQLException exp){
                    mx=exp.getMessage();
			System.out.println("ERROR:"+exp.getMessage());
		}
		catch(Exception exp){
                    mx=exp.getMessage();
			System.out.println("ERROR:"+exp.getMessage());
		}
	}
	public void cerrarBd(){
		try
		{
			cn.close(); //Cerrar Conexi�n
		}
		catch(SQLException exp){
			System.out.println(exp.getMessage());
		}
		catch(Exception exp){
			System.out.println(exp.getMessage());
		}
	}

    
}
