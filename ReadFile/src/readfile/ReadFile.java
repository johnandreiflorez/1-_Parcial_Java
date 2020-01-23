/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package readfile;

import coffeecompany.Zonas;

/**
 *
 * @author COMPUFACIL03
 */

public class ReadFile {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        // TODO code application logic here
        Stack pila =new Stack(5);
        Queue cola = new Queue(5);
        Archivos objArchivos = new Archivos();
        String linea;
        objArchivos.abrirArchivoLectura("DataBase.txt");
        int n;
        n=objArchivos.contarLineas();
       //System.out.println("Cantidad de lineas: "+n);
        objArchivos.cerrarArchivoLectura();
        objArchivos.abrirArchivoLectura("DataBase.txt");
        Cafe objCafe = null;
        Zonas objZonas = null;
        int cont=0;
        for (int i=0;i<n;i++){
            linea=objArchivos.leerUnaLineaTexto();
            //System.out.println(linea);
            //System.out.println(linea.charAt(0));
            switch (String.valueOf(linea.charAt(0))) {
                case "+":
                    //System.out.println("si entra y guarda la linea: "+linea);
                    //arrProducto.add(linea);
                    objCafe = new Cafe(linea.split(",")[0],Double.parseDouble(linea.split(",")[1]));
                    break;
                case "-":
                    //System.out.println("si entra y guarda la linea: "+linea);
                    //  arrDistribucion.add(linea);
                    objZonas = new Zonas (linea.split(",")[0],linea.split(",")[1],linea.split(",")[2],
                            linea.split(",")[3],Double.parseDouble(linea.split(",")[4]));
                    break;
                default:
                    System.out.println("no entro");
                    break;
            }
            if((i%2)!=0){
                /*System.out.println("el el paso numero: "+i+" \n"+"se guardo: "+objCafe.getTipoCafe()+" / "+
                                        objCafe.getCost()+" / "+objZonas.getCiudad()+" / "+objZonas.getZona()+" / "+
                                        objZonas.getPais()+" / "+objZonas.getNivelEdu()+" / "+objZonas.getIva());*/
                pila.push(new Container(objCafe,objZonas));
                cont++;
            }
            if(cont==5){
                //System.out.println("SE GUARDA EN COLA TODA LA INFO DE ARRIBA Y SE GREA UNA PILA NUEVA"+"\n\n");
                cola.push(pila);
                pila = new Stack(5);
                cont=0;
            }  
            //}
        }
        objArchivos.cerrarArchivoLectura();
        int contZonaNorte=0;
        int contZonaEuropea=0;
        int contZonaLatina=0;
        String zonaNorte="",zonaEuropea="",zonaLatina="";
        Container c=null;
        String [][] matriz=new String[5][5];
        int i=0,j=0;
        double valorZonaNorte=0,valorZonEuropa=0,valorZonaLatina=0;
        while(!cola.isEmpty()){
            Stack I = (Stack)cola.pop();
            while(!I.isEmpty()){
                c=(Container) I.pop();
                matriz [j][i] = c.getObjCafe().getTipoCafe();
                j++;
                if(j>=5){
                   i++;
                   j=0;
                }                
                switch(c.getObjZonas().getZona()){
                    case "-America del Norte":
                        contZonaNorte++;
                        valorZonaNorte+=(c.getObjCafe().getCost()*c.getObjZonas().getIva());
                        zonaNorte += c.getObjZonas().getCiudad()+" |||  nivel de edicacion: "+ c.getObjZonas().getNivelEdu()+"\n";
                    break;
                    case "-Europa":
                        contZonaEuropea++;
                        valorZonEuropa+=(c.getObjCafe().getCost()*c.getObjZonas().getIva());
                        zonaEuropea += c.getObjZonas().getCiudad()+"  |||  nivel de edicacion: "+ c.getObjZonas().getNivelEdu()+"\n";
                    break;
                    case "-Latinoamerica":
                        contZonaLatina++;
                        valorZonaLatina+=(c.getObjCafe().getCost()*c.getObjZonas().getIva());
                        zonaLatina += c.getObjZonas().getCiudad()+" ||| nivel de edicacion: "+ c.getObjZonas().getNivelEdu()+"\n";
                    break;
                    default:
                        System.out.println("no encontro Zona");
                }
            }
                /*while(!cola.isEmpty()){
                    //System.out.println(contador);
                    Stack I = (Stack)cola.pop();
                    c=(Container) I.pop();
                    System.out.print(c.getObjCafe().getTipoCafe()+ " | ");
                    System.out.print(i);
                    //System.out.print(c.getObjCafe().getTipoCafe()+ " __ ");
                    //contador++;
                }*/
        }
        System.out.println("PILA 1   |   PILA 2   |   PILA 3   |   PILA 4   |   PILA 5  |" );
        for(i=0;i<5;i++){
            System.out.println("______________________________________________________________");
            for(j=0;j<5;j++){
                System.out.print(matriz[i][j]+" | ");
            }
            System.out.print("\n");
        }
        
        System.out.println("\nPara la zona Norte se enviaron "+contZonaNorte+"\n"+"CIUDADES: \n"+ zonaNorte+
                                    "\n Para la zona Europea se enviaron "+contZonaEuropea+"\n"+"CIUDADES: \n"+ zonaEuropea+
                                    "\n Para la zona Latina se enviaron "+contZonaLatina+"\n"+"CIUDADES: \n"+ zonaLatina);
        System.out.println("______________________________________________________________________________");
        System.out.println("La ganacia en la zona Norte es: "+valorZonaNorte+"\n"+
                            "La ganacia en la zona Europeo es: "+ valorZonEuropa+ "\n"+
                            "La ganacia en la zona Latina es: "+ valorZonaLatina+ "\n");
    }
}
