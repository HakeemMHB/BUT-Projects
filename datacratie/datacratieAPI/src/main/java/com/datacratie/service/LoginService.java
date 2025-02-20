package main.java.com.datacratie.service;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import main.java.com.datacratie.view.LoginPage;

public class LoginService {
    private Connection connection;

    public LoginService(Connection connection) {
        this.connection = connection;
    }

    public boolean isUserDecideur(String email, String password) {
        String query = "SELECT r.nomRole FROM utilisateur u " +
                       "JOIN membre m ON u.idUtilisateur = m.idUtilisateur " +
                       "JOIN a_pour_role ar ON m.idMembre = ar.idMembre " +
                       "JOIN roles r ON ar.idRole = r.idRole " +
                       "WHERE u.adresseMailUtilisateur = ? AND u.passwordUser = ?";

        try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
            preparedStatement.setString(1, email);
            preparedStatement.setString(2, password);

            ResultSet resultSet = preparedStatement.executeQuery();
            while (resultSet.next()) {
                String role = resultSet.getString("nomRole");
                if ("decideur".equalsIgnoreCase(role)) {
                    return true;
                }
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }

    public String[] getDecideurInfo(String email) {
        String query = "SELECT prenomUtilisateur, nomUtilisateur FROM utilisateur WHERE adresseMailUtilisateur = ?";
        try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
            preparedStatement.setString(1, email);
            ResultSet resultSet = preparedStatement.executeQuery();
            if (resultSet.next()) {
                String prenom = resultSet.getString("prenomUtilisateur");
                String nom = resultSet.getString("nomUtilisateur");
                return new String[]{prenom, nom};
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return new String[]{"", ""};
    }

    public void getUserDetailsByEmail(String email) {
        String query = "SELECT idUtilisateur, idGroupe, nomUtilisateur, prenomUtilisateur, nomGroupe " +
                       "FROM vue_decideurs_groupes WHERE adresseMailUtilisateur = ?";
        try (PreparedStatement preparedStatement = connection.prepareStatement(query)) {
            preparedStatement.setString(1, email);
            ResultSet resultSet = preparedStatement.executeQuery();
            if (resultSet.next()) {
                LoginPage.idUtilisateur = resultSet.getInt("idUtilisateur");
                LoginPage.idGroupe = resultSet.getInt("idGroupe");
                LoginPage.nomUtilisateur = resultSet.getString("nomUtilisateur");
                LoginPage.prenomUtilisateur = resultSet.getString("prenomUtilisateur");
                LoginPage.nomGroupe = resultSet.getString("nomGroupe");
            }
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

}
