/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;

/**
 *
 * @author docenteitm
 */
import java.sql.ResultSet;
import modelo.Cliente;
public class ControlCliente {
    Cliente objCliente;

    public ControlCliente(Cliente objCliente) {
        this.objCliente = objCliente;
    }
   public void guardar(){
       String cd,nm;
       double cr;
       cd=objCliente.getCodigo();
       nm=objCliente.getNombre();
       cr=objCliente.getCredito();
       String cmdSql="INSERT INTO CLIENTE VALUES('"+cd+"','"+nm+"',"+cr+")";
       Conexion objConexion= new Conexion();
       objConexion.abriBD();
       objConexion.ejecutarUpdate(cmdSql);
       objConexion.cerrarBd();
   } 
   public void modificar(){
       String cd,nm;
       double cr;
       cd=objCliente.getCodigo();
       nm=objCliente.getNombre();
       cr=objCliente.getCredito();
       String cmdSql="UPDATE CLIENTE SET NOMBRE='"+nm+"',CREDITO="+cr+" WHERE CODIGO='"+cd+"'";
       Conexion objConexion= new Conexion();
       objConexion.abriBD();
       objConexion.ejecutarUpdate(cmdSql);
       objConexion.cerrarBd();
   }  
   public void borrar(){
       String cd;
       cd=objCliente.getCodigo();
       String cmdSql="DELETE FROM CLIENTE WHERE CODIGO='"+cd+"'";
       Conexion objConexion= new Conexion();
       objConexion.abriBD();
       objConexion.ejecutarUpdate(cmdSql);
       objConexion.cerrarBd();
   }  
   public Cliente consultar(){
       ResultSet objResultSet;
       String cd;
       cd=objCliente.getCodigo();
       String cmdSql="SELECT * FROM CLIENTE WHERE CODIGO='"+cd+"'";
       Conexion objConexion= new Conexion();
       objConexion.abriBD();
       objResultSet=objConexion.ejecutarSelect(cmdSql);
       try{
        if(objResultSet.next()){
           String nm=objResultSet.getString("NOMBRE");
           double cr=objResultSet.getDouble("CREDITO"); 
           objCliente.setNombre(nm);
           objCliente.setCredito(cr);
        }
       objConexion.cerrarBd();
       }
       catch(Exception objExp){
           System.out.println(objExp.getMessage());
       }
       return objCliente;
   }
    public String[][] listar(){
        String[][] mat=null;
        ResultSet objResultSet;
        Conexion objConexion= new Conexion();
        try{
        String cmdSql="SELECT count(*) FROM CLIENTE";
       objConexion.abriBD();
       objResultSet=objConexion.ejecutarSelect(cmdSql);
       //objResultSet apunta al encabezado de la tabla resultado de la consulta
       int n= 0;
       if(objResultSet.next())n= objResultSet.getInt(1);

       cmdSql="SELECT * FROM CLIENTE";
        mat=new String[n][3];
        objResultSet=objConexion.ejecutarSelect(cmdSql);
        int i=0;
        while(objResultSet.next()){
            mat[i][0]=objResultSet.getString("CODIGO");
            mat[i][1]=objResultSet.getString("NOMBRE");
            mat[i][2]=Double.toString(objResultSet.getDouble("CREDITO")); 
            i++;
        }
       }
       catch(Exception objExp){
           System.out.println(objExp.getMessage());
       }
       objConexion.cerrarBd();
       return mat;
    }
}
