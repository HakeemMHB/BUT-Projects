package main.java.com.datacratie.utils;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class DatabaseConnection {
    private static final String URL = "jdbc:mysql://projets.iut-orsay.fr:3306/saes3-lpivet";
    private static final String USER = "saes3-lpivet";
    private static final String PASSWORD = "uGEinWjCXRrl2B+r";

    private static Connection connection;

    public static Connection getConnection() {
        if (connection == null) {
            try {
                connection = DriverManager.getConnection(URL, USER, PASSWORD);
            } catch (SQLException e) {
                e.printStackTrace();
            }
        }
        return connection;
    }
}
