export type OrderItem = {
     id: string;
     date: string;
     totalPrice: number;
     address: string;
     stateOrder: string;
     stateTransport: string;
     methodOfPayment: string;
   };

export type OrderDetailItem = {
    quantity: number;
    price: number;
    productName: string;
  };

export type NewOrder = {
  address: string;
  methodOfPaymentId: number;
  stateOrderId: number;
  stateTransportId: number;
};