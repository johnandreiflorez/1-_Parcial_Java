/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package clases;

/**
 *
 * @author Andrei Florez V
 */
public class numeros {
    private int n1,n2,n3;

    public numeros() {
    }

    public int getN1() {
        return n1;
    }

    public void setN1(int n1) {
        this.n1 = n1;
    }

    public int getN2() {
        return n2;
    }

    public void setN2(int n2) {
        this.n2 = n2;
    }

    public int getN3() {
        return n3;
    }

    public void setN3(int n3) {
        this.n3 = n3;
    }
    public String validarNegativos(){
        String cadena="";
        if(n1<0)
            cadena+=String.valueOf(n1);
        if(n2<0)
            cadena+=String.valueOf(n2);
        if(n3<0)
            cadena+=String.valueOf(n3);
        return cadena;
    }
}
