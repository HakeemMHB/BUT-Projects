package main.java.com.datacratie.service;

import java.util.List;

import main.java.com.datacratie.dao.PropositionDAO;
import main.java.com.datacratie.dao.PropositionDAOImpl;
import main.java.com.datacratie.model.Proposition;

public class PropositionService {
    private PropositionDAO propositionDAO;

    public PropositionService() {
        this.propositionDAO = new PropositionDAOImpl();
    }

    public void ajouterProposition(Proposition proposition) {
        propositionDAO.ajouterProposition(proposition);
    }

    public void mettreAJourProposition(Proposition proposition) {
        propositionDAO.mettreAJourProposition(proposition);
    }

    public void supprimerProposition(int idProposition) {
        propositionDAO.supprimerProposition(idProposition);
    }

    public List<Proposition> obtenirToutesLesPropositions() {
        return propositionDAO.getToutesLesPropositions();
    }

    public Proposition obtenirPropositionParId(int idProposition) {
        return propositionDAO.getPropositionParId(idProposition);
    }
}
