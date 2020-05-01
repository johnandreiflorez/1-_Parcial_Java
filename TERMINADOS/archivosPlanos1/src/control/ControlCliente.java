/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import modelo.Clientes;
/**
 *
 * @author docenteitm
 */
public class ControlCliente {
    Clientes objClientes;

    public ControlCliente(Clientes objClientes) {
        this.objClientes = objClientes;
    }
    public void guardar(){
        Archivos objArchivos= new Archivos();
        objArchivos.abrirArchivoParaEscritura("clientes.txt");
        String cod=objClientes.getCodigo();
        String nom= objClientes.getNombre();
        String tel= objClientes.getTelefono();
        double cre=objClientes.getCredito();
        
        boolean sw=esta_no_esta();
        if(sw==false){
            String cadCliente=cod+","+nom+","+tel+","+cre;
            objArchivos.escribirUnaLineaYDebajo(cadCliente);
        }
        objArchivos.cerrarArchivoParaEscritura();
        
    }
    public void modificar(){
        String linea;
        String[] arr;
        String nom,tel;
        double cre;
      String cod= objClientes.getCodigo();
      Archivos objArchivos1 = new Archivos();
      objArchivos1.abrirArchivoParaEscritura("clientes.tmp");
      Archivos objArchivos = new Archivos();
      objArchivos.abrirArchivoParaLectura("clientes.txt");
      long n=objArchivos.contarLineas();
      objArchivos.cerrarArchivoParaLectura();
      objArchivos.abrirArchivoParaLectura("clientes.txt");
      for(int i=1;i<=n;i++){
          linea=objArchivos.leerUnaLineaTexto();
          arr=linea.split(",");
          if(!cod.equals(arr[0])){
              objArchivos1.escribirUnaLineaYDebajo(linea);
          }
          else{
              nom=objClientes.getNombre();
              tel=objClientes.getTelefono();
              cre=objClientes.getCredito();
              String cad=cod+","+nom+","+tel+","+cre;
              objArchivos1.escribirUnaLineaYDebajo(cad);
          }
      }
      objArchivos.cerrarArchivoParaLectura();
      objArchivos1.cerrarArchivoParaEscritura();
      objArchivos.borrarUnArchivo("clientes.txt");
      objArchivos.renombrarUnArchivo("clientes.tmp", "clientes.txt");
    }    
    public void borrar(){
        String linea;
        String[] arr;
      String nom,tel;
      double cre;
      String cod= objClientes.getCodigo();
      Archivos objArchivos1 = new Archivos();
      objArchivos1.abrirArchivoParaEscritura("clientes.tmp");
      Archivos objArchivos = new Archivos();
      objArchivos.abrirArchivoParaLectura("clientes.txt");
      long n=objArchivos.contarLineas();
      objArchivos.cerrarArchivoParaLectura();
      objArchivos.abrirArchivoParaLectura("clientes.txt");
      for(int i=1;i<=n;i++){
          linea=objArchivos.leerUnaLineaTexto();
          arr=linea.split(",");
          if(!cod.equals(arr[0])){
              objArchivos1.escribirUnaLineaYDebajo(linea);
          }
      }
      objArchivos.cerrarArchivoParaLectura();
      objArchivos1.cerrarArchivoParaEscritura();
      objArchivos.borrarUnArchivo("clientes.txt");
      objArchivos1.renombrarUnArchivo("clientes.tmp", "clientes.txt");      
    }    
    public Clientes consultar(){
        String cod=objClientes.getCodigo();
        Archivos objArchivos= new Archivos();
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        long n=objArchivos.contarLineas();
        objArchivos.cerrarArchivoParaLectura();
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        int i=1;
        
        while(i<=n){
        String linea=objArchivos.leerUnaLineaTexto();
        System.out.println(linea);
        String[] arr=linea.split(",");
            if(cod.equals(arr[0])){
                objClientes.setNombre(arr[1]);
                objClientes.setTelefono(arr[2]);
                objClientes.setCredito(Double.parseDouble(arr[3]));
                i=(int)n+1;
            }
        i++;
        } 
        objArchivos.cerrarArchivoParaLectura();
        return objClientes;
    }
    public boolean esta_no_esta(){
        String cad;
        String[] arrCad;
        String cod=objClientes.getCodigo();
        Archivos objArchivos= new Archivos();
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        int i=0;
        long n=objArchivos.contarLineas();
        objArchivos.cerrarArchivoParaLectura();
        boolean sw=false;
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        while(i<n && sw==false){
            cad=objArchivos.leerUnaLineaTexto();
            arrCad=cad.split(",");
            if (arrCad[0].equals(cod))sw=true;
            i=i+1;
        }
        return sw;
    }
    public String[][] listar(){//mejorar este algoritmo en caso de que el archivo sea grande ya que la matriz no resiste muchso datos
        String[][] mat;
        String linea;
        String[] arrLin;
        Archivos objArchivos= new Archivos();
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        long n=objArchivos.contarLineas();
        mat = new String[(int)n][4];
        objArchivos.cerrarArchivoParaLectura();
        objArchivos.abrirArchivoParaLectura("clientes.txt");
        for (long i=0;i<n;i++){
            linea=objArchivos.leerUnaLineaTexto();
            arrLin=linea.split(",");
            for(int j=0;j<4;j++) mat[(int)i][j]=arrLin[j];
       }
       objArchivos.cerrarArchivoParaLectura();
       return mat;
    }
}
