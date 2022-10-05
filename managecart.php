<?php 
session_start();
require("dbconnect.php");
if($_SERVER["REQUEST_METHOD"]=="POST")
{    
    if(isset($_POST['addtocart']))
    {
        if(isset($_SESSION['cart']))
        {
            $myitems=array_column($_SESSION['cart'],'product');
            if(in_array($_POST['product'],$myitems))
            {
                echo "<script>
                alert('item already added')
                window.history.back()
                </script>";
            }
            else{
                $_SESSION['checkout']=true;
                $count=count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array('image'=>$_POST['image'],'product'=>$_POST['product'],'price'=>$_POST['price'],'quantity'=>1);
                echo "<script>
                alert('item added')
                window.history.back()
                </script>";
            }
        }
        else
        {         
            $_SESSION['checkout']=true;
            $_SESSION['cart'][0]=array('image'=>$_POST['image'],'product'=>$_POST['product'],'price'=>$_POST['price'],'quantity'=>1);
            echo "<script>
            alert('item added')
            window.history.back()
            </script>";
        }
    }

    if(isset($_POST['removeproduct']))
    {   
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['product']==$_POST['product'])
            {   
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart']=array_values($_SESSION['cart']);
                echo "<script>
                alert('item removed')
                window.location.href='shoppingcart.php';
                </script>";
                if($key==0)
                {
                    $_SESSION['checkout']=false;
                }
            }
        }
    }
    if(isset($_POST['mod_quantity']))
    {
        foreach($_SESSION['cart'] as $key => $value)
        {
            if($value['product']==$_POST['product'])
            {
                $_SESSION['cart'][$key]['quantity']=$_POST['mod_quantity'];
                echo "<script>
                window.location.href='shoppingcart.php';
                </script>";            
            }
        }    
    }
}

?>