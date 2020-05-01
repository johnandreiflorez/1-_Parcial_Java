/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package control;
import Estructura.Stack;
import Modelo.Embassy;
import Modelo.PersonalData;
/**
 *
 * @author COMPUFACIL03
 */
public class AssignmentDate {
    private Stack month;

    public AssignmentDate() {
        month = new Stack (100);
    }
    public void recordData(){
        ReadDataBase objReadData = new ReadDataBase();
        Embassy objEmbassy = new Embassy();
        PersonalData objPersonalData = new PersonalData();
        objReadData.openFile();
        int sw=0;
        String line = objReadData.readerALine();
        while (!line.equals("end")) {
            if(line.equals("Documentos")){
                line = objReadData.readerALine();
                objPersonalData.setName(line.split(":")[1]);
                line = objReadData.readerALine();
                objPersonalData.setAge(line.split(":")[1]);
                line = objReadData.readerALine();
                objPersonalData.setDestinationCity(line.split(":")[1]);
                line = objReadData.readerALine();
                objPersonalData.setBankBalance(line.split(":")[1]);
                line = objReadData.readerALine();
                objPersonalData.setTitle(line.split(":")[1]);
                month.push(objPersonalData);
            }else
                if(line.equals("PILA"))
                    if(sw==0){
//                        objEmbassy.showStack(month);
                        objEmbassy.setJanuary(month);
                        month = new Stack(100);
                        sw=1;
                    }else{
//                        objEmbassy.showStack(month);
                        objEmbassy.setFebruary(month);
                    }
            line = objReadData.readerALine();
        }
        objReadData.closeFile();
    }
}
