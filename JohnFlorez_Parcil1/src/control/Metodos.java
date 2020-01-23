package control;


public class Metodos {
    
    private double promSal;
    public Metodos() {
        promSal=0;
    }
    public double calculateProm(Object mat[][]){
        
        for(int i=0;i<mat.length;i++){
            promSal+=(double)mat[i][2]-(double)mat[i][3];
        }
        return promSal/=mat.length;
    }
    public int calculatePorce(Object mat[][]){
        int cont=0;
        for(int i=0;i<mat.length;i++){
            if((double)mat[i][2]>promSal){
                cont+=1;
            }
        }
        return (cont*100)/mat.length;
    }
    public String salarioMayor (Object mat[][]){
        double temp=0;
        String name="";
        for(int i=0;i<mat.length;i++){
            if((double)mat[i][2]>temp){
                temp=(double)mat[i][2];
                name=(String)mat[i][1];
            }
        }
        return name;
    }
    
    
    
}
