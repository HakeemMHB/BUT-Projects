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
      si les vecteurs 2D n'ont pas la m�me taille
      **/
      Image(vector<vector<int>> red, vector<vector<int>> green, vector<vector<int>> blue);


      /**
        M�thode getLongueur renvoyant la longueur de l'image
      **/
      int getLongueur() const;


      /**
        M�thode getLargeur renvoyant la largeur de l'image
      **/
      int getLargeur() const;


      /**
        M�thode getRed renvoyant le tab 2D rouge
      **/
      vector<vector<int>> getRed() const;


      /**
        M�thode getGreen renvoyant le tab 2D vert
      **/
      vector<vector<int>> getGreen() const;


      /**
        M�thode getBlue renvoyant le tab 2D bleu
      **/
      vector<vector<int>> getBlue() const;


      /**
        M�thode pour changer la valeur d'un pixel
      **/
      void changePixel(int i, int j, int rouge, int vert, int bleu);


      /**
        Affiche une image
      **/
      void affiche();


      /**
      (QUESTION 3) M�thode renvoyant une nouvelle image
      en gardant uniquement le rouge de l'image de base,
      tous les autres vecteurs bleu et verts sont � 0
      **/
      Image composanteRouge() const;


      /**
      (QUESTION 4) M�thode renvoyant true si le code RVB donn� est pr�sent dans l'image
      **/
      bool detection(int r, int g, int b);


      /**
      (QUESTION 5) M�thode renvoyant une nouvelle image grise en faisant la moyenne
      du code RGB pixel par pixel
      **/
      Image niveauxGris() const;


      /**
      (QUESTION 7) M�thode renvoyant une image, si le niveau de gris d'un pixel est
      au dessus d'un seuil pass� en param�tre, le pixel devient noir. Il est blanc
      dans le cas inverse
      **/
      Image noirEtBlanc(int seuil = 100) const;


      /**
      (QUESTION 8) M�thode renvoyant un vecteur, pour chaque niveau de gris d'une image,
      il y a le nombre de fois o� il est pr�sent et son code RGB
      **/
      vector<int> histogrammeGris() const;


      /**
      (QUESTION 10) M�thode renvoyant une nouvelle image dont la luminosit� a �t� modifi�
       en multipliant chaque code RGB d'un pixel par une constante
      **/
      Image luminosity(float factor) const;


      /**
      (QUESTION 10) M�thode renvoyant une nouvelle image 1.5 fois plus lumineuse que celle de base
      **/
      Image luminosityUP() const;


      /**
      (QUESTION 10) M�thode renvoyant une nouvelle image 0.5 fois moins lumineuse que celle de base
      **/
      Image luminosityDOWN() const;


      /**
      (QUESTION 11) M�thode renvoyant une nouvelle image avec un contraste modifi�,
      en prenant chaque valeur d'un pixel, en retirant 128 puis en le multipliant par
      une constante pour au final ajouter 128. Si le r�sultat d�passe 255, c'est tout de
      m�me 255 qui sera ajout�. M�me chose avec 0.
      **/
      Image contraste(float factor) const;


      /**
      (QUESTION 11) M�thode renvoyant une nouvelle image avec un contraste 1.5 fois plus �lev� que celle de base
      **/
      Image contrasteUP() const;


      /**
      (QUESTION 11) M�thode renvoyant une nouvelle image avec un contraste 0.5 fois moins �lev� que celle de base
      **/
      Image contrasteDOWN() const;




      /**

      FIN DE LA PARTIE 1

      **/


      /**

      D�BUT DE LA PARTIE 2

      **/




      /**
      (QUESTION 2) Constructeur cr�ant une image � partir d'un fichier au format ppm
      **/
      Image(string nomImg);


      /**
      (QUESTION 3) M�thode permettant la cr�ation d'un fichier contenant l'image au format ppm
      **/
      void creer(const string &nomFichier);


      /**
      (QUESTION 4, 5) M�thode appliquant les modifications demand�es par l'utilisateur
      dans la m�thode menu
      **/
      Image appliquerFiltre(vector<int> choix);





      /**

      FIN DE LA PARTIE 2

      **/


      /**

      D�BUT DE LA PARTIE 3

      **/




      /**
      (QUESTION 1) M�thode rognant une image au niveau de la gauche en v�rifiant que c'est possible
      **/
      Image rognerD(int num = 1);


      /**
      (QUESTION 1) M�thode rognant une image au niveau de la droite en v�rifiant que c'est possible
      **/
      Image rognerG(int num = 1);


      /**
      (QUESTION 1) M�thode rognant une image au niveau du haut en v�rifiant que c'est possible
      **/
      Image rognerH(int num = 1);


      /**
      (QUESTION 1) M�thode rognant une image au niveau du bas en v�rifiant que c'est possible
      **/
      Image rognerB(int num = 1);


      /**
      (QUESTION 2) et (QUESTION 3) M�thode rognant une image vers la gauche
      **/
      Image rotationG() const;


      /**
      (QUESTION 2) et (QUESTION 3) M�thode rognant une image vers la droite
      **/
      Image rotationD() const;


      /**
      (QUESTION 4) M�thode faisant une sym�trie horizontale sur une image
      **/
      Image retournementH() const;


      /**
      (QUESTION 4) M�thode faisant une sym�trie verticale une image
      **/
      Image retournementV() const;

      /**
      (QUESTION 5) M�thode renvoyant une nouvelle image num fois plus grande
      **/
      Image agrandissement(int num = 5)const;


      /**
      (QUESTION 6) M�thode renvoyant une nouvelle image � partir d'une image (carr� ou non)
      o� chaque pixel �quivaut � un carr� num x num de l'image de base
      **/
      Image retrecissement(int num = 2)const;
};

/**
Fonction utilis�e pour afficher un unique vecteur et utile pour histogrammesGris
**/
void affiche(vector<int> &histo);


/**
(QUESTION 1, 5) Fonction permettant de renvoyer une nouvelle image modifi�e
selon les choix de l'utilisateur avec toutes les m�thodes disponibles
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
            (Question 1) M�thode application pour appliquer un filtre � une image
        **/
        Image application(const Image &i) const;
};



#endif // S102_H_INCLUDED
