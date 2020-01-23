/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Modelo;

import Estructura.Stack;

/**
 *
 * @author COMPUFACIL03
 */
public class Embassy {
    Stack january, february;

    public Embassy() {
        january = new Stack (100);
        february = new Stack (100);
    }

    public Stack getJanuary() {
        return january;
    }

    public void setJanuary(Stack january) {
        this.january = january;
    }

    public Stack getFebruary() {
        return february;
    }

    public void setFebruary(Stack february) {
        this.february = february;
    }
    public void showStack(Stack p){
        PersonalData objData;
        while(!p.isEmpty()){
            objData = (PersonalData) p.pop();
            System.out.println("el nombre es: "+objData.getName()+ " su edad es: "+objData.getAge());
        }
    }
}
