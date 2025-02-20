package main.java.com.datacratie.dao;

import java.util.List;

import main.java.com.datacratie.model.Proposition;

public interface PropositionDAO {
    void ajouterProposition(Proposition proposition);
    void mettreAJourProposition(Proposition proposition);
    void supprimerProposition(int idProposition);
    Proposition getPropositionParId(int idProposition);
    List<Proposition> getToutesLesPropositions();
}
