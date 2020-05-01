/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package servlets;

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import Modelo.persona;
import controlador.validaciones;
/**
 *
 * @author Andrei Florez V
 */
@WebServlet(name = "servletJubilacion", urlPatterns = {"/servletJubilacion"})
public class servletJubilacion extends HttpServlet {

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
            
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet servletJubilacion</title>");
            out.println("<link href='CSS/estilos.css' rel='stylesheet' type='text/css'/>");
            out.println("</head>");
            out.println("<body>");
            persona objPersona = new persona();
            
            objPersona.setNombre(request.getParameter("Nombre"));
            objPersona.setEdad(Integer.parseInt(request.getParameter("Edad")));
            objPersona.setAntiguedad(Integer.parseInt(request.getParameter("Antiguedad")));
            
            validaciones objValidaciones = new validaciones(objPersona);
            
            if(objValidaciones.validarEdad()&&objValidaciones.validarNombre()){
                out.println("<h1>CLASIFICACION</h1>");
            out.println("<br><hr><br>"
                    + "<h5>EL SEÑOR(A):  </h5>");
            out.println("<p>"+objPersona.getNombre()+"<br>"
                    + "<h5>TIPO DE JUBILACION: </h5><br><p>"+objValidaciones.clasificarJubilacion()+"</p>");
             out.println("<nav><a href='index.jsp'>VOLVER AL INICIO</a></nav>");
            }else{
                out.println("<h1>CLASIFICACION</h1>");
                out.println("<br><hr><br>");
                out.print("<h5>ERROR: </h5><br><p>"+objValidaciones.getError()+"</p>");
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
