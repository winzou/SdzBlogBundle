<?php

namespace Sdz\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Httpfoundation\Response;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BlogController extends Controller
{
    public function listeAction($page)
    {
        // On ne sait pas combien de pages il y a, mais on sait qu'une page
        // doit être supérieure ou égale à 1.
        if( $page < 1 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw new NotFoundHttpException('Page inexistante (page = '.$page.')');
        }

        // Ici, on récupérera la liste des articles, puis on la passera au template.

        // Mais pour l'instant, on ne fait qu'appeler le template.
        // Ce template n'existe pas encore, on va le créer dans le prochain chapitre.
        return $this->render('SdzBlogBundle:Blog:liste.html.twig');
    }

    public function voirAction($slug)
    {
        // Ici, on récupérera l'article correspondant au $slug.
        return $this->render('SdzBlogBundle:Blog:voir.html.twig');
    }

    public function ajouterAction()
    {
        // Ici, on s'occupera de la création et de la gestion du formulaire (via un service).

        return $this->render('SdzBlogBundle:Blog:ajouter.html.twig');
    }

    public function modifierAction($id)
    {
        // Ici, on récupérera l'article correspondant à l'$id.

        // Ici, on s'occupera de la création et de la gestion du formulaire (via un service).

        return $this->render('SdzBlogBundle:Blog:modifier.html.twig');
    }

    public function supprimerAction($id)
    {
        // Ici, on récupérera l'article correspondant à l'$id.

        // Ici, on gérera la suppression de l'article en question.

        return $this->render('SdzBlogBundle:Blog:supprimer.html.twig');
    }
}