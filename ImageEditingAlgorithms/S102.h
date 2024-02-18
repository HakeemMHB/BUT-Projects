#ifndef S102_H_INCLUDED
#define S102_H_INCLUDED
#include <vector>
#include <fstream>
using namespace std;

//Constantes pour le menu
const int QUITTER = 0;
const int COMPOSANTEROUGE = 1;
const int DETECTION = 2;
const int NIVEAUXGRIS = 3;
const int NOIRETBLANC = 4;
const int HISTOGRAMMEGRIS = 5;
const int LUMINOSITY = 6;
const int CONTRASTE = 7;

class Image {
  vector<vector<int>> _red;
  vector<vector<int>> _green;
  vector<vector<int>> _blue;
  int _longueur;
  int _largeur;

  public:

      /**
      (QUESTION 2) Constructeur renvoyant une erreur
      si les vecteurs 2D n'ont pas la même taille
      **/
      Image(vector<vector<int>> red, vector<vector<int>> green, vector<vector<int>> blue);


      /**
        Méthode getLongueur renvoyant la longueur de l'image
      **/
      int getLongueur() const;


      /**
        Méthode getLargeur renvoyant la largeur de l'image
      **/
      int getLargeur() const;


      /**
        Méthode getRed renvoyant le tab 2D rouge
      **/
      vector<vector<int>> getRed() const;


      /**
        Méthode getGreen renvoyant le tab 2D vert
      **/
      vector<vector<int>> getGreen() const;


      /**
        Méthode getBlue renvoyant le tab 2D bleu
      **/
      vector<vector<int>> getBlue() const;


      /**
        Méthode pour changer la valeur d'un pixel
      **/
      void changePixel(int i, int j, int rouge, int vert, int bleu);


      /**
        Affiche une image
      **/
      void affiche();


      /**
      (QUESTION 3) Méthode renvoyant une nouvelle image
      en gardant uniquement le rouge de l'image de base,
      tous les autres vecteurs bleu et verts sont à 0
      **/
      Image composanteRouge() const;


      /**
      (QUESTION 4) Méthode renvoyant true si le code RVB donné est présent dans l'image
      **/
      bool detection(int r, int g, int b);


      /**
      (QUESTION 5) Méthode renvoyant une nouvelle image grise en faisant la moyenne
      du code RGB pixel par pixel
      **/
      Image niveauxGris() const;


      /**
      (QUESTION 7) Méthode renvoyant une image, si le niveau de gris d'un pixel est
      au dessus d'un seuil passé en paramètre, le pixel devient noir. Il est blanc
      dans le cas inverse
      **/
      Image noirEtBlanc(int seuil = 100) const;


      /**
      (QUESTION 8) Méthode renvoyant un vecteur, pour chaque niveau de gris d'une image,
      il y a le nombre de fois où il est présent et son code RGB
      **/
      vector<int> histogrammeGris() const;


      /**
      (QUESTION 10) Méthode renvoyant une nouvelle image dont la luminosité a été modifié
       en multipliant chaque code RGB d'un pixel par une constante
      **/
      Image luminosity(float factor) const;


      /**
      (QUESTION 10) Méthode renvoyant une nouvelle image 1.5 fois plus lumineuse que celle de base
      **/
      Image luminosityUP() const;


      /**
      (QUESTION 10) Méthode renvoyant une nouvelle image 0.5 fois moins lumineuse que celle de base
      **/
      Image luminosityDOWN() const;


      /**
      (QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste modifié,
      en prenant chaque valeur d'un pixel, en retirant 128 puis en le multipliant par
      une constante pour au final ajouter 128. Si le résultat dépasse 255, c'est tout de
      même 255 qui sera ajouté. Même chose avec 0.
      **/
      Image contraste(float factor) const;


      /**
      (QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste 1.5 fois plus élevé que celle de base
      **/
      Image contrasteUP() const;


      /**
      (QUESTION 11) Méthode renvoyant une nouvelle image avec un contraste 0.5 fois moins élevé que celle de base
      **/
      Image contrasteDOWN() const;




      /**

      FIN DE LA PARTIE 1

      **/


      /**

      DÉBUT DE LA PARTIE 2

      **/




      /**
      (QUESTION 2) Constructeur créant une image à partir d'un fichier au format ppm
      **/
      Image(string nomImg);


      /**
      (QUESTION 3) Méthode permettant la création d'un fichier contenant l'image au format ppm
      **/
      void creer(const string &nomFichier);


      /**
      (QUESTION 4, 5) Méthode appliquant les modifications demandées par l'utilisateur
      dans la méthode menu
      **/
      Image appliquerFiltre(vector<int> choix);





      /**

      FIN DE LA PARTIE 2

      **/


      /**

      DÉBUT DE LA PARTIE 3

      **/




      /**
      (QUESTION 1) Méthode rognant une image au niveau de la gauche en vérifiant que c'est possible
      **/
      Image rognerD(int num = 1);


      /**
      (QUESTION 1) Méthode rognant une image au niveau de la droite en vérifiant que c'est possible
      **/
      Image rognerG(int num = 1);


      /**
      (QUESTION 1) Méthode rognant une image au niveau du haut en vérifiant que c'est possible
      **/
      Image rognerH(int num = 1);


      /**
      (QUESTION 1) Méthode rognant une image au niveau du bas en vérifiant que c'est possible
      **/
      Image rognerB(int num = 1);


      /**
      (QUESTION 2) et (QUESTION 3) Méthode rognant une image vers la gauche
      **/
      Image rotationG() const;


      /**
      (QUESTION 2) et (QUESTION 3) Méthode rognant une image vers la droite
      **/
      Image rotationD() const;


      /**
      (QUESTION 4) Méthode faisant une symétrie horizontale sur une image
      **/
      Image retournementH() const;


      /**
      (QUESTION 4) Méthode faisant une symétrie verticale une image
      **/
      Image retournementV() const;

      /**
      (QUESTION 5) Méthode renvoyant une nouvelle image num fois plus grande
      **/
      Image agrandissement(int num = 5)const;


      /**
      (QUESTION 6) Méthode renvoyant une nouvelle image à partir d'une image (carré ou non)
      où chaque pixel équivaut à un carré num x num de l'image de base
      **/
      Image retrecissement(int num = 2)const;
};

/**
Fonction utilisée pour afficher un unique vecteur et utile pour histogrammesGris
**/
void affiche(vector<int> &histo);


/**
(QUESTION 1, 5) Fonction permettant de renvoyer une nouvelle image modifiée
selon les choix de l'utilisateur avec toutes les méthodes disponibles
**/
void menu(string &nomFichier, vector<int> &choix);



void loadPicture(const string &picture, vector<vector<int>> &red,
                                        vector<vector<int>> &green,
                                        vector <vector<int>> &blue);



bool seTermineParPPM(const string& str);




class Filtre{
    vector<vector<float>> _action;
    int _rayon;

    public:
        /**
            Constructeur
        **/
        Filtre(vector<vector<float>> action, int rayon);

        /**
            (Question 1) Méthode application pour appliquer un filtre à une image
        **/
        Image application(const Image &i) const;
};



#endif // S102_H_INCLUDED
