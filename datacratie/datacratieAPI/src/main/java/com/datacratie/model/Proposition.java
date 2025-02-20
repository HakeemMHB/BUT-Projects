package main.java.com.datacratie.model;

public class Proposition {
    private int idProposition;
    private String nomProposition;
    private String descriptionProposition;
    private int idMembre;
    private int idGroupe;

    public Proposition(int idProposition, String nomProposition, String descriptionProposition, int idMembre, int idGroupe) {
        this.idProposition = idProposition;
        this.nomProposition = nomProposition;
        this.descriptionProposition = descriptionProposition;
        this.idMembre = idMembre;
        this.idGroupe = idGroupe;
    }

    public int getIdProposition() { return idProposition; }
    public void setIdProposition(int idProposition) { this.idProposition = idProposition; }

    public String getNomProposition() { return nomProposition; }
    public void setNomProposition(String nomProposition) { this.nomProposition = nomProposition; }

    public String getDescriptionProposition() { return descriptionProposition; }
    public void setDescriptionProposition(String descriptionProposition) { this.descriptionProposition = descriptionProposition; }

    public int getIdMembre() { return idMembre; }
    public void setIdMembre(int idMembre) { this.idMembre = idMembre; }

    public int getIdGroupe() { return idGroupe; }
    public void setIdGroupe(int idGroupe) { this.idGroupe = idGroupe; }
}
