package main.java.com.datacratie.test;

import main.java.com.datacratie.model.Proposition;
import main.java.com.datacratie.service.PropositionService;

public class PropositionServiceTest {

    public static void main(String[] args) {
        PropositionService propositionService = new PropositionService();

        System.out.println("Liste de toutes les propositions : ");
        propositionService.obtenirToutesLesPropositions().forEach(proposition -> {
            System.out.println("ID: " + proposition.getIdProposition() + ", Nom: " + proposition.getNomProposition());
        });
    }
}

