package com.cfpt.nfc;

/**
 * Created by GERARDT_INFO on 04.10.2017.
 */

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;

public class Connect {

    private Connection con;
    ResultSet res;
    final  String ADRESSE = "jdbc:mysql://192.168.43.165:3306";
    final String NOM_BASE = "db_target";
    final String NOM_UTILISATEUR = "mbp-di-ottavio";
    final String PASSWORD ="root";

    public void Connect(String requete){

        // Essai de connexion à la base de donnée
        try {
            res.close();
            // Chargement du driver
            Class.forName("com.mysql.jdbc.Driver");

            // Connecteur à la base avec les paramètres (Adresse+Nom_Base, Nom_Utilisateur, Password)
            con = DriverManager.getConnection(ADRESSE+"/"+NOM_BASE+NOM_UTILISATEUR+PASSWORD);
            System.out.println("Database connection success");

            // Requête sur la base
            Statement st = con.createStatement();
            res = st.executeQuery(requete);
            con.close();
        } catch (Exception e) {
            e.printStackTrace();
            e.getMessage();
        }
    }
    private  ArrayList ResultToList()
    {
         ArrayList rs = new ArrayList();
        try {
            while (res.next()) {
                rs.add(res.getString(1));
            }
        }
        catch(Exception e)
        {
            e.getMessage();
        }
        return rs;
    }
    private void ResulToArray(ResultSet rs)
    {
        /*try {
            while (rs.next()) {
                result.add(rs.getString(1));
            }
        }
        catch(Exception e)
        {
            e.getMessage();
        }*/
    }
    public boolean Login(String email,String password)
    {
        try {
            Connect("SELECT `prenom` FROM `test` WHERE `prenom`=\""+email+"\"");
            if (!((ArrayList)ResultToList()).isEmpty()){
                Connect("SELECT `mdp` FROM `test` WHERE `prenom`=\""+email+"\"");

                if(ResultToList().get(0).equals(password)){
                    return true;
                }
            }
        } catch (Exception e) {
            return false;
        }
        return false;
    }
}

