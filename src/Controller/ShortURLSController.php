<?php

namespace App\Controller;


use App\Entity\ShortUrl;
use App\Form\ShortURLGeneratorType;
use App\Form\EditShortURLGeneratorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShortURLSController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
     public function index(Request $request)
     {
        // creates shorturls object
        $shortURLS = new ShortUrl();

        $form = $this->createForm(ShortURLGeneratorType::class, $shortURLS);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $shortURLS = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($shortURLS);
            $entityManager->flush();

            // Add Success message to show to the user.
            $this->addFlash(
                'success',
                'Short URL is created.'
            );

            return $this->redirectToRoute('view_shortlink_info', ['shortlink' => $shortURLS->getShortlink()]);
        }

        return $this->render('short_urls/new.html.twig', [
            'form' => $form->createView(),
        ]);
      }

    /**
     * @Route("/view/{shortlink}", name="view_shortlink_info")
     */
     public function viewshorturlInfo(Request $request)
     {
        $shortlink = $request->get('shortlink');

        $shortlinkinfo = $this->getDoctrine()
                  ->getRepository(ShortUrl::class)
                  ->findOneBy(
                      ['shortlink' => $shortlink]
                  );

        if (!$shortlinkinfo) {
          throw $this->createNotFoundException('This URL does not exist');
        }

        return $this->render('short_urls/view.html.twig', [
            'viewshortlinkInfo' => $shortlinkinfo,
        ]);
     }

     /**
      * @Route("/edit/{shortlink}", name="edit_shortlink_info")
      */
      public function editshorturlInfo(Request $request)
      {
         $shortlink = $request->get('shortlink');

         $shortlinkinfo = $this->getDoctrine()
                   ->getRepository(ShortUrl::class)
                   ->findOneBy(
                       ['shortlink' => $shortlink]
                   );

         if (!$shortlinkinfo) {
           throw $this->createNotFoundException('This URL does not exist');
         }

         $form = $this->createForm(EditShortURLGeneratorType::class, $shortlinkinfo);
         $form->handleRequest($request);
         if ($form->isSubmitted() && $form->isValid()) {
             // $form->getData() holds the submitted values
             $shortlinks = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($shortlinks);
             $entityManager->flush();

            // Add Success message to show to the user.
             $this->addFlash(
                 'success',
                 'Tiny URL is updated.'
             );

             return $this->redirectToRoute('view_shortlink_info', ['shortlink' => $shortlinks->getShortlink()]);
         }


         return $this->render('short_urls/new.html.twig', [
             'form' => $form->createView(),
         ]);

      }

      /**
       * @Route("/delete/{shortlink}", name="delete_shortlink_info")
       */
       public function  deleteshorturlInfo(Request $request)
       {
          $shortlink = $request->get('shortlink');

          $shortlinkinfo = $this->getDoctrine()
                    ->getRepository(ShortUrl::class)
                    ->findOneBy(
                        ['shortlink' => $shortlink]
                    );

          if (!$shortlinkinfo) {
            throw $this->createNotFoundException('This URL does not exist');
          }

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($shortlinkinfo);
          $entityManager->flush();

          // Add Success message to show to the user.
          $this->addFlash(
             'success',
             'Tiny URL is deleted from the system'
          );

          return $this->redirectToRoute('index');
       }

     /**
      * @Route("/{shortlink}", name="redirect_shortlink")
      */
     public function redirectshorturl(Request $request)
     {
        $shortlink = $request->get('shortlink');

        $shortlinkinfo = $this->getDoctrine()
                 ->getRepository(ShortUrl::class)
                 ->findOneBy(
                     ['shortlink' => $shortlink]
                 );

        if (!$shortlinkinfo) {
          throw $this->createNotFoundException('This URL does not exist');
        }

        return $this->redirect($shortlinkinfo->getFullurl());
     }

    /**
     * @Route("/list/shortlinks", name="list_shortlinks")
     */
    public function listshorturlS(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(ShortUrl::class);

        // look for *all* shorturl objects
        $shortlinksinfo = $repository->findAll();

        if (!$shortlinksinfo) {
          throw $this->createNotFoundException('This URL does not exist');
        }

        return $this->render('short_urls/list.html.twig', [
            'viewshortlinkInfo' => $shortlinksinfo,
        ]);
    }
}
