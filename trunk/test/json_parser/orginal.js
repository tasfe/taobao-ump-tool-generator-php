$(function(e) {
	var a = e.cookie("o") || "pevc", b = e("#yM").toggleClass("on", a.search(/v/) != -1).click(function() {
		var p = e(this), o = p.hasClass("on");
		if (o) {
			return
		}
		e(this).addClass("on");
		i.removeClass("H").addClass("I");
		f.removeClass("on");
		m();
		e(window).resize()
	}), f = e("#xL").toggleClass("on", a.search(/v/) === -1).click(function() {
		var p = e(this), o = p.hasClass("on");
		if (o) {
			return
		}
		p.addClass("on");
		i.addClass("H").removeClass("I");
		b.removeClass("on");
		m();
		e(window).resize()
	}), k = e("#cR").toggleClass("on", a.search(/c/) != -1).click(function() {
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("color", o);
		m()
	}), l = e("#bQ").toggleClass("on", a.search(/t/) != -1).click(function() {
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("bQ", o);
		m()
	}), g = e("#aP").toggleClass("on", a.search(/i/) != -1).click(function() {
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("aP", o);
		m()
	}), h = e("#zN").toggleClass("on", a.search(/C/) != -1).click(function() {
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("compact", o);
		m()
	}), c = e("#gV").toggleClass("on", a.search(/p/) != -1).toggleClass("inactive", a.search(/e/) == -1).click(function() {
		if (!j.hasClass("on")) {
			return
		}
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("R", !o);
		j.toggleClass("inactive", !o);
		m();
		d.click()
	}), j = e("#jY").toggleClass("on", a.search(/e/) != -1).toggleClass("inactive", a.search(/p/) == -1).click(function() {
		if (!c.hasClass("on")) {
			return
		}
		var o = e(this).toggleClass("on").hasClass("on");
		n.toggleClass("S", !o);
		c.toggleClass("inactive", !o);
		m();
		d.click()
	}), i = e(".N").toggleClass("H", !b.hasClass("on")).toggleClass("I", b.hasClass("on")), d = e("#eT"), n = e("#fU").toggleClass("R", !c.hasClass("on")).toggleClass("S", !j.hasClass("on")).toggleClass("compact", h.hasClass("on")).toggleClass("color", k.hasClass("on")).toggleClass("aP", g.hasClass("on")).toggleClass("bQ", l.hasClass("on"));
	function m() {
		e.cookie("o", (c.hasClass("on") ? "p" : "") + (j.hasClass("on") ? "e" : "") + (b.hasClass("on") ? "v" : "") + (l.hasClass("on") ? "t" : "") + (g.hasClass("on") ? "i" : "") + (k.hasClass("on") ? "c" : "") + (h.hasClass("on") ? "C" : ""), {
			path : "/",
			expires : 90
		})
	}

	setTimeout(function() {
		e(".O").click(function() {
			e.get(e(this).data("json"), function(o) {
				e("#eT").val(o).click()
			}, "text")
		});
		e(".n").click(function(o) {
			if (e(this).is(".k")) {
				if (e(o.target).closest(".j").length === 0) {
					e(this).removeClass("k")
				}
			} else {
				e(".n").removeClass("k");
				e(this).addClass("k");
				o.stopPropagation();
				e("body").bind("click.dropdown", function(p) {
					if (e(p.target).closest(".j").length === 0) {
						e(".n").removeClass("k");
						e("body").unbind("click.dropdown")
					}
				})
			}
		})
	}, 0)
});
$(function() {
	var e = "H", u = function() {
		var y = false;
		u = function() {
			var A = c, z = j - q - c - d - b + 20;
			h.css("top", q - 20);
			l.outerHeight(A - 20);
			if (z === -20) {
				if (!y) {
					p.hide();
					y = true
				}
			} else {
				if (y) {
					p.show();
					y = false
				}
				p.outerHeight(z)
			}
			m.outerHeight(z - m.position().top - 2);
			$.cookie("y", "" + A, {
				path : "/",
				expires : 7
			})
		};
		u()
	}, r = function() {
		var y = false;
		r = function() {
			var D = v, B = w - v - k, A = j - q - b;
			h.css("top", q).css("width", "");
			l.outerWidth(D - 20);
			if (B === 0) {
				if (!y) {
					p.hide();
					y = true
				}
			} else {
				if (y) {
					p.show();
					y = false
				}
				p.outerWidth(B - 20)
			}
			var z = p.hasClass("R") || p.hasClass("S") ? 1 : 2, C = Math.floor(a.outerWidth() / z);
			o.eq(0).outerWidth(C);
			o.eq(2).outerWidth(C);
			o.eq(3).outerWidth(C - 1);
			m.outerHeight(A - m.position().top - 2);
			$.cookie("x", "" + D, {
				path : "/",
				expires : 7
			})
		};
		r()
	}, h = $(".N"), l = $(".J", h), p = $(".K", h), m = $(".L", p), g = $(".F", p), f = $(".y", p), a = $(".E", p), o = $(".C"), x = $(".M", h).mousedown(function() {
		x.addClass("G")
	}).mouseout(function() {
		x.removeClass("G")
	}).mouseup(function() {
		x.removeClass("G")
	}), d = x.outerHeight(), k = x.outerWidth(), v = -1, c = -1, i = $(".a"), q = -1, s = $(".r"), b = -1, j = -1, w = -1, n = $(window).resize(function() {
		var A = h.hasClass("H") ? "ns" : "ew";
		if (e !== A) {
			t(A)
		}
		switch(A) {
			case"ew":
				var G = $(this).height(), F = $(this).width(), H = i.outerHeight(), B = s.outerHeight(), I = F !== w, D = G !== j, z = H !== q, E = B !== b;
				if (v === -1) {
					v = $("body").hasClass("posted") ? 0 : $.cookie("x") ? Number($.cookie("x")) : Math.floor(F / 2.6);
					x.css("left", v)
				} else {
					if (I) {
						v = Math.floor(v * F / w);
						x.css("left", v)
					}
				}
				j = G;
				w = F;
				q = H;
				b = B;
				h.add(l).outerHeight(j - q - b);
				r();
				break;
			case"ns":
				var G = $(this).height(), F = $(this).width(), H = i.outerHeight(), B = s.outerHeight(), I = F !== w, D = G !== j, z = H !== q, E = B !== b;
				if (c === -1) {
					c = $.cookie("y") ? Number($.cookie("y")) : (G - H - B) / 2.5;
					x.css("top", c)
				} else {
					if (D) {
						c = c * (G - B) / (j - b);
						x.css("top", c)
					}
				}
				j = G;
				w = F;
				q = H;
				b = B;
				if (I) {
					h.width(w - 42);
					var C = p.hasClass("R") || p.hasClass("S") ? 1 : 2, y = Math.floor(a.innerWidth() / C);
					o.not(":eq(1)").outerWidth(y - 1);
					l.outerWidth(w - 40)
				}
				if (D || z || E) {
					h.height(j - q - b + 40);
					u()
				}
		}
	}).resize();
	function t(y) {
		switch(y) {
			case"ew":
				x.draggable({
					axis : "x",
					containment : ".N",
					cursor : "ew-resize",
					drag : function(z, A) {
						v = A.position.left;
						r()
					},
					snap : ".N",
					snapMode : "inner",
					snapTolerance : 40
				});
				h.addClass("I").removeClass("H");
				break;
			case"ns":
			default:
				x.draggable({
					axis : "y",
					containment : ".N",
					cursor : "ns-resize",
					drag : function(z, A) {
						c = A.position.top;
						u()
					},
					snap : ".N",
					snapMode : "inner",
					snapTolerance : 40
				});
				h.addClass("H").removeClass("I")
		}
		e = y;
		l.add(p).add(x).removeAttr("style");
		v = -1;
		c = -1;
		j = -1;
		w = -1;
		d = x.outerHeight();
		k = x.outerWidth()
	}

});
$(function() {
	$(".s").click(function(d) {
		var c = $(this).attr("rel");
		if ($("#popup-" + c).length > 0) {
			return
		}
		$.get("form-" + c + ".html", function(f) {
			$("#footer").after(f);
			if (c == "contact") {
				$.getScript("contact.js")
			}
			var i = $(window), g = i.width(), e = i.height(), h = $("#popup-" + c);
			h.draggable().css("z-index", b() + 1).offset({
				left : (g - h.width()) / 2,
				top : (e - h.height()) / 2
			}).mousedown(function() {
				var j = $(this).css("z-index");
				$(this).css("z-index", b() + 1)
			});
			$(".u", h).add(".t", h).click(function() {
				h.remove()
			})
		}, "text");
		d.preventDefault()
	});
	$(window).keydown(function(c) {
		if (c.keyCode == "27") {
			var d = a();
			if (d) {
				d.remove()
			}
			c.preventDefault()
		}
	});
	function a() {
		var d = 2001, c;
		$(".v").each(function() {
			var e = $(this).css("z-index");
			if (e > d) {
				d = Number(e);
				c = $(this)
			}
		});
		return c
	}

	function b() {
		var c = a();
		return (c) ? Number(c.css("z-index")) : 2001
	}

});
$(function(d) {
	var D = d.cookie("o") || "pecT",
		w = d("body"),
		G = "online",
		a = d("#eT").keyup(function() {
			j("keyup")
		}).click(function() {
			j("click")
		}).focus(),
		r = d("#iX"),
		B = d("#hW"),
		n = d("#lA"),
		k = d("#kZ"),
		f = r.add(n),
		l = d("#gV"),
		u = d("#jY"),
		s = "/",
		g = a.hasClass("posted"),
		c = D.search(/e/) != -1,
		h = "fr",
		p = 100,
		b = "parser",
		v = d("html"),
		o = d(window),
		q = ".",
		i = d("#favicon"),
		y = d("#footer"),
		A = "json",
		z = "object",
		m = "array",
		C = "string",
		F = "number",
		e = "boolean",
		x = "http:" + s + s + A + q + b + q + G + q + h + s;
	/*if ((document.location + "").search(x) !== 0) {
		d = null;
		return
	}*/
	d(".P").delegate(".toggle", "click", function() {
		var H = d(this).parent();
		if (H.length == 0) {
			H = d(this).closest(".P")
		}
		H.toggleClass("collapsed");
		return false
	});

	function t(I) {
		function H(J) {
			function K(O) {
				if (O === null) {
					return "null"
				}
				if (typeof(O) === "object" && O.length) {
					return "array"
				}
				return typeof O
			}
			function N(O, Q, T) {
				var P = "",
					S, R;
				for (R in O) {
					if (O.hasOwnProperty(R)) {
						if (P !== "") {
							P += T
						}
						S = O[R];
						if (S === undefined) {
							S = null
						}
						if (Q !== "array") {
							P += '<span class="property">';
							P += (Q === "object") ? '"<span class="p">' + R + '</span>"</span>:' : '<span class="p">' + R + "</span></span>:"
						}
						P += H(S)
					}
				}
				return P
			}
			var M = "",
				L = K(J);
			switch (L) {
			case "object":
				M = '<span class="' + L + '"><span class="toggle">{</span><ul><li>' + N(J, L, ",</li><li>") + '</li></ul><span class="toggle-end">}</span></span>';
				break;
			case "array":
				M = '<span class="' + L + '"><span class="toggle">[</span><ol><li>' + N(J, L, ",</li><li>") + '</li></ol><span class="toggle-end" card="' + J.length + '">]</span></span>';
				break;
			case "null":
				M = '<span class="' + L + '">' + L + "</span>";
				break;
			case "string":
				M = '<span class="' + L + '">"' + J + '"</span>';
				break;
			default:
				M = '<span class="' + L + '">' + J + "</span>";
				break
			}
			return M
		}
		return H(I)
	}
	function E(O) {
		function I(T) {
			return Q(J(T))
		}
		function J(T) {
			return T.replace(/\s+$/g, "")
		}
		function Q(T) {
			return T.replace(/^\s+/g, "")
		}
		function K() {
			var V = 0,
				U, T;
			do {
				V = N.indexOf('"', V + 1), U = 0, T = 1;
				do {
					if (N.substring(V - T, V - T + 1) === "\\") {
						U = U + 1;
						T++;
						continue
					}
					break
				} while (true);
				if (U % 2 === 0) {
					break
				}
			} while (true);
			return V
		}
		function L(U) {
			function T(X) {
				function V(ac) {
					var aa, Z, Y, ab = ac.substring(0, 1);
					ac.update("");
					if (ab === '"') {
						aa = ac.shift(K(ac.todo) + 1);
						if (aa.search(/\\u(?![\d|A-F|a-f]{4})/g) !== -1) {
							return ac.err("\\u must be followed by 4 hexadecimal characters", aa)
						}
						length = aa.length;
						for (Y = 0; Y < length; Y++) {
							if (aa.substring(Y, Y + 1) == "\\") {
								if (Y + 1 < length) {
									Y++;
									if (!aa.substring(Y, Y + 1).search(/[^\"|\\|\/|b|f|n|r|t|u]/)) {
										return ac.err("Backslash must be escaped", aa)
									}
								}
							}
						}
						return ac.update('<span class="property">"<span class="p">' + aa.substring(1, aa.length - 1) + '</span>"</span>')
					}
					aa = ac.shift(ac.indexOf(":"));
					return ac.err("Name property must be a String wrapped in double quotes.", aa)
				}
				function W(Y) {
					if (Y.substring(0, 1) !== ":") {
						Y.err("Semi-column is missing.", Y.shift(Y.indexOf(":")))
					}
					return Y.swap(1)
				}
				X.update("<li>");
				if (X.substring(0, 1) === "}") {
					return X.update("</li>")
				}
				X = V(X);
				X = W(X);
				X = M(X, "}");
				if (X.substring(0, 1) === ",") {
					X.swap(1).update("</li>");
					return T(X)
				}
				if (X.substring(0, 1) === "}") {
					return X.update("</li>")
				}
				return X.err("Comma is missing", X.shift(X.indexOf("}"))).update("</li>")
			}
			if (U.indexOf("{") === -1) {
				U.err("Opening brace is missing", U.todo);
				return U.update("", "")
			} else {
				U.shift(1);
				U.update('<span class="object"><span class="toggle">{</span><ul>');
				U = T(U).update("</ul>");
				if (U.indexOf("}") === -1) {
					U.err("Closing brace is missing", U.todo);
					return U.update("", "")
				}
				return U.span("toggle-end", U.shift(1))
			}
		}
		function H(U) {
			var V = 0;

			function T(X, W) {
				X.update("<li>");
				X = M(X, "]");
				if (X.substring(0, 1) === ",") {
					X.swap(1).update("</li>");
					return T(X, ++V)
				}
				if (X.substring(0, 1) === "]") {
					return X.update("</li>")
				}
				return X.err("Comma is missing", X.shift(X.search(/(,|\])/))).update("</li>")
			}
			if (U.indexOf("[") === -1) {
				U.err("Opening square bracket is missing", U.todo);
				return U.update("", "")
			}
			U.shift(1);
			U.update('<span class="array">');
			U.update('<span class="toggle">[</span><ol>');
			if (U.indexOf("]") === 0) {
				U.shift(1);
				U.update('</ol><span class="toggle-end" card="0">]</span>');
				return U.update("</span>")
			}
			U = T(U, 0);
			if (U.indexOf("]") === -1) {
				U.err("Closing square bracket is missing", U.todo);
				U.update('</ol><span class="toggle-end" card="' + (V + 1) + '"></span>');
				return U.update("</span>")
			}
			U.shift(1);
			U.update('</ol><span class="toggle-end" card="' + (V + 1) + '">]</span>');
			return U.update("</span>")
		}
		function M(Z, U) {
			var ab, X, V, T, W, aa = "";
			if (Z.search(/^(")/) === 0) {
				ab = Z.shift(K(Z.todo) + 1);
				if (ab.search(/\\u(?![\d|A-F|a-f]{4})/g) !== -1) {
					return Z.err("\\u must be followed by 4 hexadecimal characters", ab)
				}
				T = ab.length;
				for (V = 0; V < T; V++) {
					if (ab.substring(V, V + 1) == "\\") {
						if (V + 1 < T) {
							V++;
							if (!ab.substring(V, V + 1).search(/[^\"|\\|\/|b|f|n|r|t|u]/)) {
								return Z.err("Backslash must be escaped", ab)
							}
						}
					}
				}
				return Z.span("string", ab)
			}
			if (Z.search(/^\{/) === 0) {
				return L(Z)
			}
			if (Z.search(/^\[/) === 0) {
				return H(Z)
			}
			X = Z.search(new RegExp("(,|" + U + ")"));
			if (X === -1) {
				X = Z.todo.length - 1;
				W = J(Z.todo);
				Z.update("", "")
			} else {
				W = J(Z.shift(X))
			}
			try {
				aa = typeof d.parseJSON(W)
			} catch (Y) {}
			switch (aa) {
			case "boolean":
			case "number":
				return Z.span(aa, W);
			default:
				if (W === "null") {
					return Z.span("null", W)
				} else {
					if (W.search(/^(')/) === 0) {
						return Z.err("String must be wrapped in double quotes", W)
					}
					return Z.err("Unknown type", W)
				}
			}
		}
		var P = false,
			R = function(T) {
				this.done = "";
				this.todo = T ? T : "";
				this.update = function(V, U) {
					if (V) {
						this.done += V
					}
					if (U !== undefined) {
						this.todo = Q(U)
					}
					return this
				};
				this.swap = function(U) {
					if (U && !isNaN(Number(U)) && this.todo.length >= U) {
						this.update(this.todo.substr(0, U), this.todo.substring(U))
					}
					return this
				};
				this.toString = function() {
					if (this.todo.length !== 0) {
						this.err("Text after last closing brace.", this.todo)
					}
					return this.done
				};
				this.span = function(U, V) {
					return this.update('<span class="' + U + '">' + V + "</span>")
				};
				this.err = function(V, U) {
					P = true;
					return this.update('<span class="error" title="' + V + '">' + U + "</span>")
				};
				this.shift = function(U) {
					var V;
					if (U && !isNaN(Number(U)) && this.todo.length >= U) {
						V = this.substring(0, U);
						this.update("", this.substring(U));
						return J(V)
					}
					return ""
				};
				this.indexOf = function(V, U) {
					if (U) {
						return this.todo.indexOf(V, U)
					} else {
						return this.todo.indexOf(V)
					}
				};
				this.substring = function(U, V) {
					if (V) {
						return this.todo.substring(U, V)
					} else {
						return this.todo.substring(U)
					}
				};
				this.search = function(U) {
					return this.todo.search(U)
				}
			},
			N = new R(I(O)),
			S;
		if (Q(O).substr(0, 1) === "[") {
			S = {
				html: H(N).toString(),
				valid: !P
			}
		} else {
			if (Q(O).substr(0, 1) === "{") {
				S = {
					html: L(N).toString(),
					valid: !P
				}
			} else {
				S = {
					html: N.err("JSON expression must be an object or an array", O).update(null, "").toString(),
					valid: false
				}
			}
		}
		return S
	}
	function j(J) {
		var K = a.val(),
			I = '<link rel="icon" type="image/png" href="/favicon',
			H = '.png" id="favicon"/>';
		if (d.trim(K) === "") {
			r.html("");
			n.html("");
			i.after(I + H).remove();
			w.addClass("json-empty").removeClass("json-error");
			B.html("String is empty");
			k.html("&nbsp;");
			return
		}
		w.removeClass("json-empty json-error");
		K = K.replace(/</g, "&lt;");
		K = K.replace(/>/g, "&gt;");
		if (l.hasClass("on")) {
			setTimeout(function() {
				var M = E(K),
					N = d(M.html, document),
					L;
				N.find(".p").each(function() {
					if (d(this).closest("li").find("li").length !== 0) {
						d(this).addClass("collapsible")
					}
				});
				r.html(N);
				if (M.valid) {
					i.after(I + H).remove();
					B.html("String parse")
				} else {
					i.after(I + "ko" + H).remove();
					L = M.html.match(/class="error"/g).length;
					B.html("String parse:&nbsp;<b>" + L + "&nbsp;error" + (L > 1 ? "s" : "") + "</b>");
					w.addClass("json-error")
				}
				o.resize()
			}, 0)
		} else {
			r.html("");
			B.html("")
		}
		if (u.hasClass("on")) {
			setTimeout(function() {
				try {
					var L = t(d.parseJSON(K)),
						N = d(L, document);
					k.html("JS eval");
					N.find(".p").each(function() {
						if (d(this).closest("li").find("li").length !== 0) {
							d(this).addClass("collapsible")
						}
					});
					n.html(N)
				} catch (M) {
					n.html('<span class="error">' + M + "</span>");
					k.html("JS eval <b>fails</b>");
					w.addClass("json-error")
				}
				o.resize()
			}, 0)
		} else {
			n.html("");
			k.html("")
		}
	}
	if (x.length !== 29) {
		d = null;
		return
	}
	j();
});