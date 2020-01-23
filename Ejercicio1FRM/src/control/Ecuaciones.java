
package control;

public class Ecuaciones {
    //atributos o propiedades
    private double a,b,c,x1,x2;
    //metodos
        //constructor se usa para inicializar atributos
    public Ecuaciones(double a, double b, double c, double x1, double x2) {
        this.a = a;
        this.b = b;
        this.c = c;
        this.x1 = x1;
        this.x2 = x2;
    }
    public Ecuaciones() {
        a= 0;
        b = 0;
        this.c = 0;
        x1 =0;
        x2 = 0;
     }
    public Ecuaciones(double a1,double b1,double c1) {
        a= a1;
        b = b1;
        this.c = c1;
        x1 =0;
        x2 = 0;
     }
                //get sirve para enviar el parametro
    public double getA() {
        return a;
    }
    public double getB() {
        return b;
    }
    public double getC() {
        return c;
    }
    public double getX1() {
        return x1;
    }
    public double getX2() {
        return x2;
    }
                // ser sirve para modificar el parametro
    public void setA(double a) {
        this.a = a;
    }
    public void setB(double b) {
        this.b = b;
    }
    public void setC(double c) {
        this.c = c;
    }
                             //atributo
    public String calcular (){
        String msg="ok";
        if(a!=0)
            if(b*b-4*a*c>=0){
                x1=(-b+Math.sqrt(b*b-4*a*c))/(2*a);
                x2=(-b+Math.sqrt(b*b-4*a*c))/(2*a);
            }else
                msg="la soluión no esta en los reales";
        else
            msg="Error, División por cero";
        return msg;
    }
}
