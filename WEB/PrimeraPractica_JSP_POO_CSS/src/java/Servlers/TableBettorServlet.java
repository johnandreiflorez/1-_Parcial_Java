/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Servlers;

import Modelo.Bet;
import Modelo.Bettor;
import Modelo.Horse;
import java.io.IOException;
import java.io.PrintWriter;
import javafx.geometry.HorizontalDirection;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Andrei Florez V
 */
@WebServlet(name = "TableBettorServlet", urlPatterns = {"/TableBettorServlet"})
public class TableBettorServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        try (PrintWriter out = response.getWriter()) {
            /* TODO output your page here. You may use following sample code. */

		// Obtengo los datos de la peticion
		
                out.println("<!DOCTYPE html>");
                out.println("<html>");
                out.println("<head>");
                out.println("<title>Servlet TableBettorServlet</title>");            
                out.println("</head>");
                out.println("<body>");
                String nombre = request.getParameter("Nombre");
		String apuesta = request.getParameter("Apuesta");
		String caballo = request.getParameter("Caballo");

		// Compruebo que los campos del formulario tienen datos para añadir a la tabla
		if (!nombre.equals("") && !apuesta.equals("") && !caballo.equals("")) {
			// Creo el objeto persona y lo añado al arrayList
//			Persona persona = new Persona(nombre, apellido, edad);
//			personas.add(persona);
                    Bettor objBettor = new Bettor(nombre);
                    Horse objHorse = new Horse(Integer.parseInt(caballo));
                    Bet objBet = new Bet(objHorse,Double.parseDouble(apuesta));
                    out.println("<table style= cellspacing='1' bgcolor='#0099cc'>");
                    out.println("<tr>");
                    out.println("<td style= rowspan='7' align='center' bgcolor='#f8f8f8'> NOMBRE CABALLO </td>");			
                    out.println("<td style= rowspan='7' align='center' bgcolor='#f8f8f8'>APUESTA</td>");
                    out.println("</tr>");
                    objBettor.addBet(objBet);
                    
                    for(int i=0; i<objBettor.sizeBets(); i++){
                            Bet auxBet = objBettor.getBetAt(i);
                            out.println("<tr>");
                            out.println("<td style= rowspan='7' align='center' bgcolor='#f8f8f8'>"+auxBet.getHorse().getName()+"</td>");			
                            out.println("<td style= rowspan='7' align='center' bgcolor='#f8f8f8'>"+auxBet.getAmount()+"</td>");
                            out.println("</tr>");
                    }
                    out.println("</table>");
                }
                out.println("</body>");
                out.println("</html>");
		            
        }        
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
