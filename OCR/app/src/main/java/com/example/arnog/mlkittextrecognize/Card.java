package com.example.arnog.mlkittextrecognize;

import android.net.Uri;

import java.util.ArrayList;

public class Card {
    private static String nom = " ";
    private static String prenom = " ";
    private static String mail = " ";
    private static String telephone = " ";
    private static String adresse = " ";
    private static String localite = " ";
    private static String nomSociete = " ";
    private static String metier = " ";
    private static String site = " ";
    private static Uri image;


    public Card() {
    }

    public Card(String nom,String prenom, String mail, String telephone,String adresse, String localite, String nomSociete, String metier, String site){
        this.nom = nom;
        this.prenom = prenom;
        this.mail = mail;
        this.telephone = telephone;
        this.adresse = adresse;
        this.localite = localite;
        this.nomSociete = nomSociete;
        this.metier = metier;
        this.site = site;


    }
    public static ArrayList<String> getArray() {
        ArrayList<String> cat = new ArrayList<String>();
        cat.add(nom);
        cat.add(prenom);
        cat.add(mail);
        cat.add(telephone);
        cat.add(adresse);
        cat.add(localite);
        cat.add(nomSociete);
        cat.add(metier);
        cat.add(site);

        return cat;
    }

    public String getNom() {
        return nom;
    }

    public static void setNom(String nom) {
        nom = nom;
    }

    public static String getPrenom() {
        return prenom;
    }

    public static void setPrenom(String prenom) {
        prenom = prenom;
    }

    public String getMail() {
        return mail;
    }

    public static void setMail(String mail) {
        mail = mail;
    }

    public String getTelephone() {
        return telephone;
    }

    public void setTelephone(String telephone) {
        this.telephone = telephone;
    }

    public String getAdresse() {
        return adresse;
    }

    public void setAdresse(String adresse) {
        this.adresse = adresse;
    }

    public String getLocalite() {
        return localite;
    }

    public void setLocalite(String localite) {
        this.localite = localite;
    }

    public String getNomSociete() {
        return nomSociete;
    }

    public void setNomSociete(String nomSociete) {
        this.nomSociete = nomSociete;
    }

    public String getMetier() {
        return metier;
    }

    public void setMetier(String metier) {
        this.metier = metier;
    }

    public String getSite() {
        return site;
    }

    public void setSite(String site) {
        this.site = site;
    }

    public static Uri getImage() {
        return image;
    }

    public static void setImage(Uri image) {
        Card.image = image;
    }

}
