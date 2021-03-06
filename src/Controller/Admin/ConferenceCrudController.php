<?php

namespace App\Controller\Admin;

use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
// use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConferenceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Conference::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            // ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('city'),
            TextField::new('year'),
            BooleanField::new('isInternational'),
            
        ];

        // Verifico en que pagina estoy y en fucnion de esto utilizo una u otra variable.
        if($pageName == Crud::PAGE_INDEX or $pageName == Crud::PAGE_DETAIL) {
            $fields[] = CollectionField::new('comments');
            $fields[] = TextField::new('slug');
            // $fields[] = DateTimeField::new('updatedAt');
            $fields[] = IntegerField::new('id');
        }

        return $fields;
    }
}
