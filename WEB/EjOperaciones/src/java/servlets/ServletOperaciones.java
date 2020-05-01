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
import clases.Operacion;

/**
 *
 * @author Andrei Florez V
 */
@WebServlet(name = "ServletOperaciones", urlPatterns = {"/ServletOperaciones"})
public class ServletOperaciones extends HttpServlet {

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
            int numero1,numero2,resultado;
            Operacion objOperacion = new Operacion();
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            
            
            out.println("<head>");
            out.println("<title>Resultado operacion</title>");            
            out.println("</head>");
            
            
            out.println("<body>");
            if(request.getParameter("btnSumar") != null){
                numero1 = Integer.parseInt(request.getParameter("txtNumero1"));
                numero2 = Integer.parseInt(request.getParameter("txtNumero2"));
                objOperacion.setNumero1(numero1);
                objOperacion.setNumero2(numero2);
                
                resultado = objOperacion.sumar();
                out.println("<h1>El resultado de la suma es: "+resultado+"</h1>");
                out.println("<a href=operacionSuma.jsp>VOLVER A LA SUMA</a>");
            }else{
                numero1 = Integer.parseInt(request.getParameter("txtNumero1"));
                numero2 = Integer.parseInt(request.getParameter("txtNumero2"));
                objOperacion.setNumero1(numero1);
                objOperacion.setNumero2(numero2);
                
                resultado = objOperacion.resta();
                out.println("<h1>El resultado de la resta es: "+resultado+"</h1>");
                out.println("<a href=operacionResta.jsp>VOLVER A LA RESTA</a>");
            }
            out.println("<br>");
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
