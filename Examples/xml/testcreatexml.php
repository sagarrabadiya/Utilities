<?php
/** @var following can be array to be converted in to xml
 *
    the attributes of tag will be in @attributes key and it will be array of name and value
 *
 * Array2XML conversion array convensions
 *  attributes stored as key value pairs under ['tag_name']['@attributes']
    CDATA nodes are stored under ['tag_name']['@cdata']
    In case a node has attributes, the value will be stored in ['tag_name']['@value']
 */
$books = array(
    '@attributes' => array(
        'type' => 'fiction'
    ),
    'book' => array(
        array(
            '@attributes' => array(
                'author' => 'George Orwell'
            ),
            'title' => '1984'
        ),
        array(
            '@attributes' => array(
                'author' => 'Isaac Asimov'
            ),
            'title' => 'Foundation',
            'price' => '$15.61'
        ),
        array(
            '@attributes' => array(
                'author' => 'Robert A Heinlein'
            ),
            'title' =>  'Stranger in a Strange Land',
            'price' => array(
                '@attributes' => array(
                    'discount' => '10%'
                ),
                '@value' => '$18.00'
            )
        )
    )
);

require_once "../../Utilities.php";

Utilities::initXML();

/** converts array to xml 1st argument will be the root element to be written 2nd argument will be array of elements as above
 * 3rd argument will be file name to be saved! can contain absolute or relative path
 */
Utilities::Array2XML('books',$books,'test.xml');

/* xml 2 array  conversion you can give the xml string to be converted! */
r(Utilities::XML2Array(file_get_contents('test.xml')));