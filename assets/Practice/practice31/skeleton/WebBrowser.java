/*  
 * CS1020 (AY2012/3 Sem2)  
 * Sit-in Lab #3 Morning session
 * Author    :   
 * Matric no.:   
 * Lab group : 
 * Description of program:   
 */ 

import java.util.*;

class ListNode <E> {  /* data attributes */  
  private E element;  
  private ListNode <E> next;
  
  /* constructors */  
  public ListNode(E item) { this(item, null); }
  public ListNode(E item, ListNode <E> n) { element = item; next = n; }

  /* get the next ListNode */  
  public ListNode <E> getNext() { return next; }
  
  /* get the element of the ListNode */  
  public E getElement() { return element; }
  
  /* set the next reference */  
  public void setNext(ListNode <E> n) { next = n; } 
}

class LinkedList <E> {  
  private ListNode <E> head = null;  

  public boolean isEmpty() { return (head == null); }
  
  public E getFirst() throws NoSuchElementException {   
    if (head == null) 
      throw new NoSuchElementException("can't get from an empty list");   
    else return head.getElement();  
  }
 
  /* return the reference to the first node in the list */
  public ListNode <E> getHead() { return head; }

}


/* WebBrowser Simulator */
public class WebBrowser {
  public WebBrowser(Scanner sc) {}

  public static void main(String[] args) {         
    Scanner sc = new Scanner(System.in);     
    WebBrowser bc = new WebBrowser(sc);

  }
}
