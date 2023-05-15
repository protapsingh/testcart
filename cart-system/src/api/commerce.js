/**
 * Mocking client-server processing
 */
const _products = [
  { pid: 1, title: "iPad 4 Mini", price: 499.99, inventory: 2, },
  { pid: 2, title: "H&M T-Shirt White", price: 10.99, inventory: 14, },
  { pid: 3, title: "Charli XCX - Sucker CD", price: 19.99, inventory: 5, },
  { pid: 4, title: "Google Pixel 3", price: 799.99, inventory: 6, },
];

export default {
  getProducts(cb) {
    setTimeout(() => cb(_products), 100);
  },
};
