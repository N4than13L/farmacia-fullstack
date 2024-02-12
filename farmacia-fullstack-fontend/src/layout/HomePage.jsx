import React from "react";

export const HomePage = () => {
  return (
    <>
      <div
        id="carouselExampleCaptions"
        className="carousel slide mb-3"
        data-bs-ride="false"
      >
        <div className="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="0"
            className="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleCaptions"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
        </div>
        <div className="carousel-inner">
          <div className="carousel-item active">
            <img
              src="https://images.pexels.com/photos/3850689/pexels-photo-3850689.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
              className="d-block w-100"
              alt="..."
            />
            <div className="carousel-caption d-none d-md-block">
              <p>aquí puedes encontrar tus medicamentos a precio acequible</p>
            </div>
          </div>
          <div className="carousel-item">
            <img
              src="https://images.pexels.com/photos/5998512/pexels-photo-5998512.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
              className="d-block w-100"
              alt="..."
            />
            <div className="carousel-caption d-none d-md-block">
              <p>Estamos disponibles las 24Hrs al dia a tu disposicion </p>
            </div>
          </div>
          <div className="carousel-item">
            <img
              src="https://images.pexels.com/photos/4210615/pexels-photo-4210615.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"
              className="d-block w-100"
              alt="..."
            />
            <div className="carousel-caption d-none d-md-block">
              <p>
                Some representative placeholder content for the third slide.
              </p>
            </div>
          </div>
        </div>
        <button
          className="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="prev"
        >
          <span
            className="carousel-control-prev-icon"
            aria-hidden="true"
          ></span>
          <span className="visually-hidden">Previous</span>
        </button>
        <button
          className="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleCaptions"
          data-bs-slide="next"
        >
          <span
            className="carousel-control-next-icon"
            aria-hidden="true"
          ></span>
          <span className="visually-hidden">Next</span>
        </button>
      </div>
      <div className="container bg-body mt-3 rounded-3 mb-3">
        <section className="container text-center mb-3">
          <h1>Bienvenido a Farmacia los Mameyes</h1>
          <p>
            En Farmacia los Mameyes, nos enorgullece ser tu destino confiable
            para todas tus necesidades de salud y bienestar. Con un compromiso
            inquebrantable con la calidad y el servicio, estamos aquí para
            cuidar de ti y tu familia.
          </p>
          <div className="mb-3 mt-1">
            <h2>Nuestros Servicios:</h2>
            <li>
              <strong>Amplia Gama de Medicamentos:</strong> Desde medicamentos
              de venta libre hasta recetas especializadas, tenemos todo lo que
              necesitas para mantener tu salud en óptimas condiciones.
            </li>
            <li>
              <strong>Asesoramiento Profesional:</strong> Nuestro equipo de
              farmacéuticos altamente capacitados está disponible para responder
              a tus preguntas y brindarte asesoramiento experto sobre
              medicamentos y cuidado personal.
            </li>
            <li>
              <strong>Productos de Cuidado Personal:</strong> Descubre una
              amplia selección de productos de cuidado personal, desde vitaminas
              hasta productos para el cuidado de la piel, que te ayudarán a
              sentirte bien por dentro y por fuera.
            </li>
            <li>
              <strong>Entrega a Domicilio:</strong> Ofrecemos un servicio
              conveniente de entrega a domicilio para que puedas recibir tus
              medicamentos y productos de cuidado personal directamente en tu
              puerta.
            </li>
          </div>

          <article className="mb-3">
            <strong>Por qué Elegirnos:</strong>{" "}
            <strong>Compromiso con la Calidad:</strong>
            <p>
              Garantizamos la calidad de todos nuestros productos para tu
              tranquilidad y bienestar. Atención Personalizada: Nos preocupamos
              por cada cliente y nos esforzamos por brindar un servicio
              personalizado y amable. Conveniencia: Desde la fácil navegación en
              nuestro sitio web hasta la entrega a domicilio, hacemos que sea
              conveniente cuidar de tu salud.
            </p>
          </article>

          <article className="container">
            <strong>¡Haz tu Pedido Hoy!</strong>
            <p>
              Explora nuestra amplia gama de productos y servicios, y haz tu
              pedido hoy mismo. Estamos aquí para servirte y ser tu aliado en el
              camino hacia una vida más saludable.
            </p>
          </article>
        </section>
      </div>
    </>
  );
};
