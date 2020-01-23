/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package ebajadaejerciciopilascolas;

/**
 *
 * @author salak404
 */
public class DocumentosPersona {
    private String name;
    private double balance;
    private String interviewDate;
    private int age;

    public DocumentosPersona() {
    }

    public DocumentosPersona(String name, double balance, String interviewDate,int age) {
        this.name = name;
        this.balance = balance;
        this.interviewDate = interviewDate;
        this.age = age;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public double getBalance() {
        return balance;
    }

    public void setBalance(double balance) {
        this.balance = balance;
    }

    public String getInterviewDate() {
        return interviewDate;
    }

    public void setInterviewDate(String interviewDate) {
        this.interviewDate = interviewDate;
    }
    
}
