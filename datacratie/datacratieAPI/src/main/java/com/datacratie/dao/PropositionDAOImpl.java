package main.java.com.datacratie.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;

import main.java.com.datacratie.model.Proposition;
import main.java.com.datacratie.utils.DatabaseConnection;

public class PropositionDAOImpl implements PropositionDAO {

    private Connection conn = DatabaseConnection.getConnection();

    @Override
    public void ajouterProposition(Proposition proposition) {
        String sql = "INSERT INTO proposition (nomProposition, descriptionProposition, idMembre, idGroupe) VALUES (?, ?, ?, ?)";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, proposition.getNomProposition());
            stmt.setString(2, proposition.getDescriptionProposition());
            stmt.setInt(3, proposition.getIdMembre());
            stmt.setInt(4, proposition.getIdGroupe());
            stmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void mettreAJourProposition(Proposition proposition) {
        String sql = "UPDATE proposition SET nomProposition = ?, descriptionProposition = ? WHERE idProposition = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setString(1, proposition.getNomProposition());
            stmt.setString(2, proposition.getDescriptionProposition());
            stmt.setInt(3, proposition.getIdProposition());
            stmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void supprimerProposition(int idProposition) {
        String sql = "DELETE FROM proposition WHERE idProposition = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, idProposition);
            stmt.executeUpdate();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    @Override
    public Proposition getPropositionParId(int idProposition) {
        String sql = "SELECT * FROM proposition WHERE idProposition = ?";
        try (PreparedStatement stmt = conn.prepareStatement(sql)) {
            stmt.setInt(1, idProposition);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return new Proposition(
                    rs.getInt("idProposition"),
                    rs.getString("nomProposition"),
                    rs.getString("descriptionProposition"),
                    rs.getInt("idMembre"),
                    rs.getInt("idGroupe")
                );
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return null;
    }

    @Override
    public List<Proposition> getToutesLesPropositions() {
        List<Proposition> propositions = new ArrayList<>();
        String sql = "SELECT * FROM proposition";

        try (Connection conn = DatabaseConnection.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            while (rs.next()) {
                propositions.add(new Proposition(
                    rs.getInt("idProposition"),
                    rs.getString("nomProposition"),
                    rs.getString("descriptionProposition"),
                    rs.getInt("idMembre"),
                    rs.getInt("idGroupe")
                ));
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return propositions;
    }

}
