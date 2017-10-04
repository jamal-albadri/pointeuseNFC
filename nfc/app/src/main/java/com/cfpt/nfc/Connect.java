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
    ArrayList result = new ArrayList();
    final  String ADRESSE = "jdbc:mysql://192.168.43.165:3306";
    final String NOM_BASE = "db_target";
    final String NOM_UTILISATEUR = "mbp-di-ottavio";
    final String PASSWORD ="root";

    public void Connect(String requete){
        // Essai de connexion à la base de donnée
        try {
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
    private  void ResulToList(ResultSet rs)
    {
        try {
            while (rs.next()) {
                result.add(rs.getString(1));
            }
        }
        catch(Exception e)
        {
            e.getMessage();
        }
    }
    private void ResulToArray(ResultSet rs)
    {
        try {
            while (rs.next()) {
                result.add(rs.getString(1));
            }
        }
        catch(Exception e)
        {
            e.getMessage();
        }
    }
    public boolean Login(String email,String password)
    {
        try {
            Connect("SELECT `prenom` FROM `test` WHERE `prenom`=\""+email+"\"");
            if (!task.getListeRes().isEmpty()){
                Connect("SELECT `mdp` FROM `test` WHERE `prenom`=\""+email+"\"");

                if(task.getListeRes().get(1).equals(password)){
                    System.out.println("FUCKING YEAAAAAH");
                    return true;
                }
            }
        } catch (Exception e) {
            return false;
        }
        return false;
    }

    public ResultSet GetResultat() {
        return res;
    }

    public ArrayList getListeRes(){
        return result;
    }
}

