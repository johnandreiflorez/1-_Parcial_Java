/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import javax.swing.JOptionPane;
import modelo.Bulto;
/**
 *
 * @author Andrei Florez V
 */
public class LlenarBoing {
    private int cont;
    private int mayor, menor, pesoTotal;
    private Bulto [] equipajes;
    private boolean sw;

    public LlenarBoing() {
        this.cont = 0;
        this.mayor = 0;
        menor = 0;
        this.pesoTotal = 0;
        equipajes = new Bulto[15];
        this.sw = true;
    }
    
    
    
    public int cargar (int i, Bulto paquete){
        cont++;
        cotizar(paquete);
        equipajes[i]=paquete;
        if(sw){
            mayor= paquete.getPeso();
            sw=false;
            menor= paquete.getPeso();
        }else
            if(mayor < paquete.getPeso())
                mayor = paquete.getPeso();
            else
                if(menor>paquete.getPeso())
                    menor = paquete.getPeso();
        pesoTotal+=  paquete.getPeso();
        if(pesoTotal >=18000){
            JOptionPane.showMessageDialog(null, "EL AVIO NO PUEDE CAGAR MAS PAQUETES. PESO CARGADO: " + pesoTotal );
            return 15;
        }
        return cont;
    }
    private void cotizar (Bulto paquete){
        if(paquete.getPeso()>=0 && paquete.getPeso()<26)
            paquete.setCosto(0);
        else
            if(paquete.getPeso()>=26 && paquete.getPeso()<301)
                paquete.setCosto(pesosDolares(1500*paquete.getPeso()));
        else
            if(paquete.getPeso()>=301 && paquete.getPeso()<501)
                paquete.setCosto(pesosDolares(2500*paquete.getPeso()));
    }

    @Override
    public String toString() {
        return "Datos{" + "Numero de bultos =" + cont + ", Bulto mas pesado=" + mayor + ", Bulto mas liviano=" + menor + ", Promedio de peso="
                + pesoTotal/cont + '}';
    }

    public Bulto[] getEquipajes() {
        return equipajes;
    }
    
    public double pesosDolares (double pesos){
      return (pesos*0.00031);
    }
}
